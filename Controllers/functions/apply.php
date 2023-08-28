<?php

use App\Models\UsersModel;
use App\Models\ApplicationModel;
use App\Models\AdvertisementModel;
use App\Models\CandidateModel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require ROOT . '/Controllers/functions/PHPMailer/src/Exception.php';
require ROOT . '/Controllers/functions/PHPMailer/src/PHPMailer.php';
require ROOT . '/Controllers/functions/PHPMailer/src/SMTP.php';

function apply(int $ad_id, string $candidate_id)
{
    if(!isset($_SESSION["is_connected"]) || !isset($_SESSION["id"])) {
        $response = [
            "error" => 1,
            "redirect" => "/inscription",
            "msg" => ""
        ];
        return $response;
    } else {
        $application_model = new ApplicationModel;
        // Check if user has already applied for this ad
        $result = $application_model->findBy(["candidate_id" => $candidate_id, "advertisement_id" => $ad_id]);
        if($result) {
            $response = [
                "error" => 1,
                "redirect" => "",
                "msg" => "Vous avez déjà postulé pour cette offre !"
            ];
            return $response;
        } else {
            $datas = [
                "candidate_id" => $candidate_id,
                "advertisement_id" => $ad_id,
            ];
            if(!$application_model->create($datas)) {
                $response = [
                    "error" => 1,
                    "redirect" => "",
                    "msg" => ""
                ];
                return $response;
            } else {
                $users_model = new UsersModel;
                $advertisement_model = new AdvertisementModel;
                $candidate_model = new CandidateModel;
                
                $mail = new PHPMailer(true);
                $to = $advertisement_model->getRecruiterMail($ad_id)[0]["mail_to"];
                $title = $advertisement_model->findBy(["id" => $ad_id])[0]["title"];
                $user = $users_model->findBy(["id" => $_SESSION["id"]])[0];
                $candidate = $candidate_model->findBy(["id" => $_SESSION["id"]])[0];
                $candidate_mail = $user["email"];
                $candidate_cv = $candidate["cv_path"];
                if(!is_null($candidate_cv)) {
                    $mail->addAttachment(ROOT . '/uploads\/' . $candidate_cv);
                }

                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "recrutementtrt@gmail.com";
                $mail->Password = "qlhhpafqblpvprnr";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->setFrom("recrutementtrt@gmail.com");
                $mail->addAddress($to);
                $mail->isHTML(true);
                $mail->Subject = "Nouvelle candidature";
                $mail->Body = "Bonjour, " . $candidate_mail . " a postulé pour votre offre d'emploi " . $title;
                $mail->send();

                $response = [
                    "error" => 0,
                    "redirect" => "",
                    "msg" => "Candidature posée !"
                ];
                return $response;
            }
        }
    }
}