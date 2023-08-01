<?php

use App\Models\ApplicationModel;

function apply(int $ad_id, string $user_id)
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
        $result = $application_model->findBy(["candidate_id" => $user_id, "advertisement_id" => $ad_id]);
        if($result) {
            $response = [
                "error" => 1,
                "redirect" => "",
                "msg" => "Vous avez déjà postulé pour cette offre !"
            ];
            return $response;
        } else {
            $datas = [
                "candidate_id" => $user_id,
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