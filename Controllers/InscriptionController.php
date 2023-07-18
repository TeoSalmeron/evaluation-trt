<?php

namespace App\Controllers;

use App\Controllers\Controller;

class InscriptionController extends Controller
{
    public function index()
    {
        $this->render("inscription/inscription",
        [
            "title" => "TRT - Créez votre compte"
        ],
        ["nav", "signup"]);
    }

    public function candidate_sign_up()
    {
        require_once ROOT . '/Controllers/functions/candidate_sign_up.php';
        $response = candidate_sign_up();  
        echo json_encode($response);
    }

    public function recruiter_sign_up() 
    {
        require_once ROOT . '/Controllers/functions/recruiter_sign_up.php';
        $response = recruiter_sign_up();
        echo json_encode($response);
    }
}
