<?php

use App\Models\UsersModel;
use App\Models\CandidateModel;
use App\Core\Form;

function candidate_sign_up() {
    $form = new Form;
    // Check e-mail
    if(!$form->verifyEmail($_POST["email"])) {
        $response = [
            "error" => 1,
            "msg" => "E-mail au mauvais format ou manquant"
        ];
        return $response;
    } else {
        // Check if password exists
        if(!$form->issetFormItem($_POST["password"]) || !$form->issetFormItem($_POST["confirm_password"])) {
            $response = [
                "error" => 1,
                "msg" => "Mots de passe manquant"
            ];
            return $response;
        } else {
            // Check if passwords respect rules
            if(!$form->verifyPasswordFormat($_POST["password"]) || !$form->verifyPasswordFormat($_POST["confirm_password"])) {
                $response = [
                    "error" => 1,
                    "msg" => "Les mots de passe doivent respecter les contraintes"
                ];
                return $response;
            } else {
                // Check if passwords are similar
                if(!$form->verifySimilarPasswords($_POST["password"], $_POST["confirm_password"])) {
                    $response = [
                        "error" => 1,
                        "msg" => "Les mots de passe doivent être identiques"
                    ];
                    return $response;
                } else {
                    // Search for user in database
                    $users_model = new UsersModel;
                    $user = $users_model->findBy(["email" => $_POST["email"]]);
                    // Check if user exists
                    if($user) {
                        $response = [
                            "error" => 1,
                            "msg" => "Vous avez déjà créé un compte chez nous"
                        ];
                        return $response;
                    } else {
                        // Check if user sent a CV
                        if($_FILES["cv"]["error"] == 4) {
                            $cv = "";
                        } else {
                            // CV has been sent
                            $content_dir = "../uploads/";
                            $tmp_file = $_FILES["cv"]["tmp_name"];
                            // Check if file size is not over 10Mo
                            if($_FILES["cv"]["size"] > 10000000) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Le fichier est trop volumineux, il ne doit pas excéder 10Mo"
                                ];
                                return $response;
                            } else {
                                // Check if file extension is PDF
                                $file_extension = substr($_FILES["cv"]["name"], -4);
                                if($file_extension !== ".pdf") {
                                    $response = [
                                        "error" => 1,
                                        "msg" => "Le fichier n'est pas au bon format, il doit être en PDF"
                                    ];
                                    return $response;
                                } else {
                                    // Move file into "uploads" folder with unique name
                                    $file_name = uniqid("") . ".pdf";
                                    if(!move_uploaded_file($tmp_file, $content_dir . $file_name)) {
                                        $response = [
                                            "error" => 1,
                                            "msg" => "Impossible d'enregistrer votre CV"
                                        ];
                                        return $response;
                                    } else {
                                        $cv = $file_name;
                                    }
                                }
                            }
                        }

                        // Check if user gave last name
                        if(!$form->issetFormItem($_POST["last_name"])) {
                            $last_name = "";
                        } else {
                            // Check if last name is in right format
                            if(!$form->verifyName($_POST["last_name"])) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Le nom de famille est incorrect"
                                ];
                                return $response;
                            } else {
                                $last_name = strtolower(htmlspecialchars(strip_tags(trim($_POST["last_name"]))));
                            }
                        }

                        // Check if user gave first name
                        if(!$form->issetFormItem($_POST["first_name"])) {
                            $first_name = "";
                        } else {
                            // Check if first name is in right format
                            if(!$form->verifyName($_POST["first_name"])) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Le prénom est incorrect"
                                ];
                                return $response;
                            } else {
                                $first_name = strtolower(htmlspecialchars(strip_tags(trim($_POST["first_name"]))));
                            }
                        }

                        // Prepare users data
                        $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
                        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $id = uniqid("", true);
                        $datas = [
                            "id" => $id,
                            "email" => $email,
                            "password" => $password,
                            "verified" => "0"
                        ];

                        // Create new user
                        if(!$users_model->create($datas)) {
                            $response = [
                                "error" => 1,
                                "msg" => "Impossible de créer le nouvel utilisateur"
                            ];
                            return $response;
                        } else {
                            $candidate_model = new CandidateModel;
                            // Prepare candidate datas
                            $datas = [
                                "id" => $id,
                                "last_name" => $last_name,
                                "first_name" => $first_name,
                                "cv_path" => $cv
                            ];
                            
                            // Create new candidate
                            if(!$candidate_model->create($datas)) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Impossible de créer le nouveau candidat"
                                ];
                                return $response;
                            } else {
                                // SUCCESS
                                $response = [
                                    "error" => 0,
                                    "msg" => "Création du compte réussie, un consultant doit valider votre profil, vous obtiendrez une réponse par mail dans les plus brefs délais"
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