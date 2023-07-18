<?php

use App\Core\Form;
use App\Models\UsersModel;
use App\Models\CandidateModel;
use App\Models\RecruiterModel;
use App\Models\ConsultingModel;
use App\Models\AdministratorModel;

function sign_in()
{
    $form = new Form();
    // Check e-mail
    if(!$form->verifyEmail($_POST["email"])) {
        $response = [
            "error" => 1,
            "msg" => "L'e-mail est invalide ou inexistant"
        ];
        return $response;
    } else {
        // Check password
        if(!$form->verifyPassword($_POST["password"])) {
            $response = [
                "error" => 1,
                "msg" => "Insérez votre mot de passe"
            ];
            return $response;
        } else {
            $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
            // Check if user exists
            $users_model = new UsersModel();
            $user = $users_model->findUser($email);
            if(!$user) {
                $response = [
                    "error" => 1,
                    "msg" => "Vous devez d'abord créer un compte"
                ];
                return $response;
            } else {
                // Check passwords
                if(!password_verify($_POST["password"], $user["password"])) {
                    $response = [
                        "error" => 1,
                        "msg" => "Mot de passe incorrect"
                    ];
                    return $response;
                } else {
                    $id = $user["id"];
                    // Check user role
                    $administrator_model = new AdministratorModel();
                    $admin = $administrator_model->findBy(["user_id" => $id]);
                    if(!$admin) {
                        // Check if user is consulting
                        $consulting_model = new ConsultingModel();
                        $consulting = $consulting_model->findBy(["user_id" => $id]);
                        if(!$consulting) {
                            // Check if user is recruiter
                            $recruiter_model = new RecruiterModel();
                            $recruiter = $recruiter_model->findBy(["user_id" => $id]);
                            if(!$recruiter) {
                                // Check if user is candidate
                                $candidate_model = new CandidateModel();
                                $candidate = $candidate_model->findBy(["user_id" => $id]);
                                if(!$candidate) {
                                    $response = [
                                        "error" => 1,
                                        "msg" => "Impossible de retrouver vos données en base de données"
                                    ];
                                    return $response;
                                } else {
                                    $user_role = "candidate";
                                }
                            } else {
                                $user_role = "recruiter";
                            }
                        } else {
                            $user_role = "consulting";
                        }
                    } else {
                        $user_role = "admin";
                    }
                    // Check if user is verified
                    if($user["verified"] == 0) {
                        $response = [
                            "error" => 1,
                            "msg" => "Votre compte est en cours de vérification, veuillez attendre l'e-mail de validation de votre compte et réessayez"
                        ];
                        return $response;
                    } else {
                        $_SESSION["is_connected"] = true;
                        $_SESSION["user_role"] = $user_role;
                        $_SESSION["user_id"] = $id;
                        $response = [
                            "error" => 0
                        ];
                        return $response;
                    }
                }
            }
        }
    }
}