<?php

namespace App\Controllers;

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
                "nav"
            ]);
        }
    }

    public function consultant()
    {
        if($_SESSION["user_role"] !== "consulting") {
            http_response_code(404);
            echo "Accès refusé";
            die();
        } else {
            $this->render("consultant/consultant",
            [
                "title" => "TRT - Panneau des consultants"
            ], [
                "nav"
            ]);
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