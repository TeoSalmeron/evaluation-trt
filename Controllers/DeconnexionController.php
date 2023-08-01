<?php

namespace App\Controllers;

use App\Controllers\Controller;

class DeconnexionController extends Controller 
{
    public function index()
    {
        unset($_SESSION["is_connected"]);
        unset($_SESSION["user_role"]);
        unset($_SESSION["id"]);
        session_destroy();
        header('Location: /');
        die();
    }
}