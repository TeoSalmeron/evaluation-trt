<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CandidateModel;
use App\Models\RecruiterModel;
use App\Controllers\Controller;

class ProfilController extends Controller
{
    public function index()
    {
        if(!isset($_SESSION["is_connected"]) || $_SESSION["is_connected"] == 0) {
            http_response_code(404);
            echo "Accès interdit";
            die();
        } else {
            switch($_SESSION["user_role"]) {
                case "admin":
                    header('Location: /profil/admin');
                    die();
                    break;
                case "candidate":
                    header('Location: /profil/candidat');
                    die();
                    break;
                case "consulting":
                    header('Location:/profil/consultant');
                    die();
                    break;
                case "recruiter":
                    header('Location: /profil/employeur');
                    die();
                    break;
                default:
                    header('Location: /');
                    die();
            }
        }
    }

    public function admin()
    {
        if($_SESSION["user_role"] !== "admin") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            $this->render("admin/admin",
            [
                "title" => "TRT - Panneau d'administration"
            ],[
                "nav", "admin"
            ]);
        }
    }

    public function ajout_consultant()
    {
        if($_SESSION["user_role"] !== "admin") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            require_once ROOT . '/Controllers/functions/add_consulting.php';
            $response = add_consulting();
            echo json_encode($response);
        }
    }

    public function consultant()
    {
        if($_SESSION["user_role"] !== "consulting") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            $recruiter_model = new RecruiterModel;
            $candidate_model = new CandidateModel;
            $unconfirmed_recruiters = $recruiter_model->returnAllUnconfirmedUsers("recruiter");
            $unconfirmed_candidates = $candidate_model->returnAllUnconfirmedUsers("candidate");

            $this->render("consultant/consultant",
            [
                "title" => "TRT - Panneau des consultants",
                "unconfirmed_recruiters" => $unconfirmed_recruiters,
                "unconfirmed_candidates" => $unconfirmed_candidates
            ], [
                "nav", "consulting"
            ]);
        }
    }

    public function consultant_actions() {
        require_once ROOT . '/Controllers/functions/confirm_user.php';
        require_once ROOT . '/Controllers/functions/delete_user.php';


        switch($_POST["action"]) {
            case "confirm_recruiter":
                echo json_encode(confirm_user($_POST["id"]));
                break;
            case "delete_recruiter":
                echo json_encode(delete_user($_POST["id"], "recruiter"));
                break;
            case "confirm_candidate":
                echo json_encode(confirm_user($_POST["id"]));
                break;
            case "delete_candidate":
                echo json_encode(delete_user($_POST["id"], "candidate"));
                break;
            case "nb_unconfirmed_users":
                $users_model = new UsersModel;
                $unconfirmed_users = $users_model->returnAllUnconfirmedUsers($_POST["role"]);
                if(!$unconfirmed_users) {
                    $response = [
                        "status" => "empty"
                    ];
                } else {
                    $response = [
                        "status" => "not empty"
                    ];
                }
                echo json_encode($response);
                break;
        }
    }

    public function employeur()
    {
        if($_SESSION["user_role"] !== "recruiter") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            $this->render("employeur/employeur",
            [
                "title" => "TRT - Mon profil"
            ],[
                "nav"
            ]);
        }
    }

    public function candidat()
    {
        if($_SESSION["user_role"] !== "candidate") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            $this->render("candidat/candidat",
            [
                "title" => "TRT - Mon profil"
            ],[
                "nav"
            ]);
        }
    }
}