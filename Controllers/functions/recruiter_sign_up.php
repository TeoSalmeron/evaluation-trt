<?php

use App\Models\RecruiterModel;
use App\Models\UsersModel;

function recruiter_sign_up()
{
    // Check email
    if(!isset($_POST["email"]) || empty($_POST["email"]) || $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $response = [
            "error" => 1,
            "msg" => "Veuillez renseigner l'e-mail au bon format"
        ];
        return $response;
    } else {
        // Check company name
        if(!isset($_POST["company_name"]) || empty($_POST["company_name"]) || $_POST["company_name"] == "") {
            $response = [
                "error" => 1,
                "msg" => "Veuillez renseigner le nom de votre entreprise"
            ];
            return $response;
        } else {
            // Check address
            if(!isset($_POST["address"]) || empty($_POST["address"]) || $_POST["address"] == "") {
                $response = [
                    "error" => 1,
                    "msg" => "Veuillez renseigner le nom de votre entreprise"
                ];
                return $response;
            } else {
                // Check passwords
                if(!isset($_POST["password"]) || !isset($_POST["confirm_password"]) || empty($_POST["password"]) || empty($_POST["confirm_password"]) || $_POST["password"] == "" || $_POST["confirm_password"] == "") {
                    $response = [
                        "error" => 1,
                        "msg" => "Veuillez insérer les mots de passes"
                    ];
                    return $response;
                } else {
                    // Check if passwords are similar
                    if($_POST["password"] !== $_POST["confirm_password"]) {
                        $response = [
                            "error" => 1,
                            "msg" => "Les mots de passe doivent être identiques"
                        ];
                        return $response;
                    } else {
                        // Check if password respect rules
                        $uppercase = preg_match('@[A-Z]@', $_POST["password"]);
                        $lowercase = preg_match('@[a-z]@', $_POST["password"]);
                        $number = preg_match('@[0-9]@', $_POST["password"]);
                        $special_chars = preg_match('@[^\w]@', $_POST["password"]);

                        if(!$uppercase || !$lowercase || !$number || !$special_chars || strlen($_POST["password"]) < 8) {
                            $response = [
                                "error" => 1,
                                "msg" => "Le mot de passe doit respecter les contraintes"
                            ];
                            return $response;
                        } else {
                            // Check if user exists
                            $users_model = new UsersModel;
                            $user = $users_model->findBy(["email" => $_POST["email"]]);
                            if($user) {
                                $response = [
                                    "error" => 1,
                                    "msg" => "Vous avez déjà créé un compte chez nous"
                                ];
                                return $response;
                            } else {
                                // Prepare datas
                                $company_name = htmlspecialchars(strip_tags(trim($_POST["company_name"])));
                                $address = htmlspecialchars(strip_tags(trim($_POST["address"])));
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
                                        "user_id" => $id,
                                        "company_name" => $company_name,
                                        "address" => $address
                                    ];
                                    if(!$recruiter_model->create($recruiter_datas)) {
                                        $response = [
                                            "error" => 1,
                                            "msg" => "Impossible de créer le nouvel employeur"
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