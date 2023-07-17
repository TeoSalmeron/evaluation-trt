<?php

namespace App\Controllers;

use App\Models\UserModel;

class DefaultController extends Controller
{
    public function index()
    {
        $this->render("home", [
            "title" => "TRT - Emploi restauration et hôtellerie"
        ], ["nav"]);
    }
}
