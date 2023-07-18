<?php

namespace App\Controllers;

class ConnexionController extends Controller 
{
    public function index()
    {
        $this->render("connexion/connexion",
        [
            "title" => "TRT - Connectez vous à votre compte"
        ],
        [
            "nav",
            "signin"
        ]);
    }

    public function sign_in()
    {
        require_once ROOT . '/Controllers/functions/sign_in.php';
        $response = sign_in();
        echo json_encode($response);
    }
}