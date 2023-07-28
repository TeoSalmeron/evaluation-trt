<?php

use App\Models\RecruiterModel;
use App\Models\UsersModel;
use App\Core\Form;

function recruiter_sign_up() {
    $form = new Form;
    // Check e-mail
    if(!$form->verifyEmail($_POST["email"])) {
        $response = [
            "error" => 1,
            "msg" => "E-mail au mauvais format ou manquant"
        ];
        return $response;
    } else {
        // Check company name
        if(!$form->issetFormItem($_POST["company_name"])) {
            $response = [
                "error" => 1,
                "msg" => "Veuillez renseigner le nom de l'entreprise"
            ];
            return $response;
        } else {
            // Check address
            if(!$form->issetFormItem($_POST["address"])) {
                $response = [
                    "error" => 1,
                    "msg" => "Veuillez renseigner votre adresse"
                ];
                return $response; 
            } else {
                // Check passwords
                if(!$form->issetFormItem($_POST["password"]) || !$form->issetFormItem(["confirm_password"])) {
                    $response = [
                        "error" => 1,
                        "msg" => "Veuillez insérer les mots de passes"
                    ];
                    return $response;
                } else {
                    // Check if passwords are the same
                    if(!$form->verifySimilarPasswords($_POST["password"], $_POST["confirm_password"])) {
                        $response = [
                            "error" => 1,
                            "msg" => "Les mots de passe doivent être identiques"
                        ];
                        return $response;
                    } else {
                        // Check if password respect the rules
                        if(!$form->verifyPasswordFormat($_POST["password"])) {
                            $response = [
                                "error" => 1,
                                "msg" => "Le mot de passe doit respecter les contraintes"
                            ];
                            return $response;
                        } else {
                            $users_model = new UsersModel;
                            // Check if user exists
                            $user = $users_model->findBy(["email" => $_POST["email"]]);
                            if($user) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Vous avez déjà créé un compte chez nous"
                                ];
                                return $response;
                            } else {
                                // Prepare datas
                                $company_name = strtolower(htmlspecialchars(strip_tags(trim($_POST["company_name"]))));
                                $address = strtolower(htmlspecialchars(strip_tags(trim($_POST["address"]))));
                                $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
                                $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                                $id = uniqid("", true);
                                $user_datas = [
                                    "id" => $id,
                                    "email" => $email,
                                    "password" => $password,
                                    "verified" => "0"
                                ];
                                
                                // Create user
                                if(!$users_model->create($user_datas)) {
                                    $response = [
                                        "error" => 1,
                                        "msg" => "Impossible de créer le nouvel utilisateur"
                                    ];
                                    return $response;
                                } else {
                                    // Create recruiter
                                    $recruiter_model = new RecruiterModel;
                                    $recruiter_datas = [
                                        "id" => $id,
                                        "company_name" => $company_name,
                                        "address" => $address
                                    ];
                                    if(!$recruiter_model->create($recruiter_datas)) {
                                        $response = [
                                            "error" => 1,
                                            "msg" => "Impossible de créer l'employeur"
                                        ];
                                        return $response;
                                    } else {
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
    }
}