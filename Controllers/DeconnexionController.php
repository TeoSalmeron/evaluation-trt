<?php

namespace App\Controllers;

use App\Controllers\Controller;

class DeconnexionController extends Controller 
{
    public function index()
    {
        session_destroy();
        header('Location: /');
        die();
    }
}