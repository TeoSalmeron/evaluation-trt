<?php

use App\Core\Form;
use App\Models\ConsultingModel;
use App\Models\UsersModel;

function add_consulting()
{
    $form = new Form;
    // Check e-mail
    if(!$form->verifyEmail($_POST["email"])) {
        $response = [
            "error" => 1,
            "msg" => "E-mail au mauvais format ou manquant"
        ];
        return $response;
    } else {
        // Check password
        if(!$form->issetFormItem($_POST["password"]) || !$form->issetFormItem($_POST["confirm_password"])) {
            $response = [
                "error" => 1,
                "msg" => "Veuillez insérer le mot de passe"
            ];
            return $response;
        } else {
            // Check if passwords respect rules
            if(!$form->verifyPasswordFormat($_POST["password"])) {
                $response = [
                    "error" => 1,
                    "msg" => "Les mots de passe ne respectent pas les contraintes"
                ];
                return $response;
            } else {
                // Check if passwords are the same
                if(!$form->verifySimilarPasswords($_POST["password"], $_POST["confirm_password"])) {
                    $response = [
                        "error" => 1,
                        "msg" => "Les mots de passe doivent correspondrent"
                    ];
                    return $response;
                } else {
                    // Clean datas
                    $id = uniqid("", true);
                    $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);


                    // Check if user already exists
                    $users_model = new UsersModel;
                    $user = $users_model->findBy(["email" => $email]);
                    if($user) {
                        $response = [
                            "error" => 1,
                            "msg" => "Cet utilisateur existe déjà"
                        ];
                        return $response;
                    } else {
                        // Create new user
                        $user_datas = [
                            "id" => $id,
                            "email" => $email,
                            "password" => $password,
                            "verified" => "1"
                        ];
                        if(!$users_model->create($user_datas)) {
                            $response = [
                                "error" => 1,
                                "msg" => "Impossible de créer le nouvel utilisateur"
                            ];
                            return $response;
                        } else {
                            $consulting_model = new ConsultingModel;
                            $consulting_datas = [
                                "user_id" => $id
                            ];
                            if(!$consulting_model->create($consulting_datas)) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Impossible de créer le nouveau consultant"
                                ];
                                return $response;
                            } else {
                                $response = [
                                    "error" => 0,
                                    "msg" => "Consultant créé !"
                                ];
                                return $response;
                            }

                        }
                    }                   
                }
            }
        }
    }
}