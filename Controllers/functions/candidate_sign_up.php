<?php

use App\Models\UsersModel;
use App\Models\CandidateModel;

function candidate_sign_up() {
    // Check if email exists
    if(!isset($_POST["email"]) || empty($_POST["email"]) || $_POST["email"] == "") {
        $response = [
            "error" => 1,
            "msg" => "Veuillez renseigner l'e-mail"
        ];
        return $response;
    } else {
        // Check if e-mail is correct
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $response = [
                "error" => 1,
                "msg" => "Format de l'e-mail incorrect"
            ];
            return $response;
        } else {
            // Check if passwords are set
            if(!isset($_POST["password"]) || !isset($_POST["confirm_password"]) || empty($_POST["password"]) || empty($_POST["confirm_password"]) || $_POST["password"] == "" || $_POST["confirm_password"] == "") {
                $response = [
                    "error" => 1,
                    "msg" => "Veuillez insérer les mots de passes"
                ];
                return $response;
            } else {
                // Check if passwords are the same
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
                        $users_model = new UsersModel();
                        $user = $users_model->findBy(["email" => $_POST["email"]]);
                        if($user) {
                            $response = [
                                "error" => 1,
                                "msg" => "Vous avez déjà créé un compte chez nous"
                            ];
                            return $response;
                        } else {
                            // Check if cv exists
                            if($_FILES["cv"]["error"] == 4) {
                                $cv = "";
                            } else {
                                // Check if file size is not over 10Mo
                                $_SERVER["REQUEST_METHOD"] = "POST";
                                $content_dir = "../uploads/";
                                $tmp_file = $_FILES['cv']['tmp_name'];
                                if($_FILES["cv"]["size"] > 10000000) {
                                    $response = [
                                        "error" => 1,
                                        "msg" => "Le fichier est trop volumineux"
                                    ];
                                    return $response;
                                } else {
                                    // Check if file is pdf
                                    if(!strstr($_FILES["cv"]["type"], "pdf")) {
                                        $response = [
                                            "error" => 1,
                                            "msg" => "Fichier non autorisé, veuillez sélectionner un PDF"
                                        ];
                                        return $response;
                                    } else {
                                        $name_file = uniqid("") . '.pdf';
                                        if(!move_uploaded_file($tmp_file, $content_dir.$name_file)) {
                                            $response = [
                                                "error" => 1,
                                                "msg" => "Le fichier n'a pas pu être envoyé"
                                            ];
                                            return $response;
                                        } else {
                                            $cv = $name_file;
                                        }
                                    }
                                }
                            }
                            // Prepare datas
                            $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
                            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                            $id = uniqid("", true);
                            $datas = [
                                "id" => $id,
                                "email" => $email,
                                "password" => $password,
                                "verified" => "0"
                            ];
                            // Check if first name and last name has been set
                            $last_name = htmlspecialchars(strip_tags(trim($_POST["last_name"])));
                            $first_name = htmlspecialchars(strip_tags(trim($_POST["first_name"])));
                            if(!empty($first_name) || $first_name !== "") {
                                if(!preg_match("/^[A-Za-z\é\è\ê\-]+$/", $first_name)) {
                                    $response = [
                                        "error" => 1,
                                        "msg" => "Le prénom est incorrect"
                                    ];
                                    return $response;
                                } else {
                                    if(!empty($last_name) || $last_name !== "") {
                                        if(!preg_match("/^[A-Za-z\é\è\ê\-]+$/", $last_name)) {
                                            $response = [
                                                "error" => 1,
                                                "msg" => "Le nom de famille est incorrect"
                                            ];
                                            return $response;
                                        } else {
                                            // Add new user
                                            if(!$users_model->create($datas)) {
                                                $response = [
                                                    "error" => 1,
                                                    "msg" => "Impossible de créer le nouvel utilisateur"
                                                ];
                                                return $response;
                                            } else {
                                                // Add new candidate
                                                $candidate_model = new CandidateModel();
                                                $datas = [
                                                    "user_id" => $id,
                                                    "first_name" => strtolower($first_name),
                                                    "last_name" => strtolower($last_name),
                                                    "cv_path" => $cv
                                                ];
                                                if(!$candidate_model->create($datas)) {
                                                    $response = [
                                                        "error" => 1,
                                                        "msg" => "Impossible de créer le nouveau candidat"
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
        }
    }   
}