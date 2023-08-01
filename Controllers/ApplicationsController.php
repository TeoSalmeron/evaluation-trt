<?php

namespace App\Controllers;

class ApplicationsController extends Controller {

    public function index() {

    }

    public function action() {
        if(!isset($_SESSION["is_connected"])) {
            $response = [
                "error" => 1,
                "redirect" => "/inscription"
            ];
            echo json_encode($response);
        } else {
            require_once ROOT . '/Controllers/functions/apply.php';
            switch($_POST["action"]) {
                case "apply":
                    echo json_encode(apply($_POST["id"], $_SESSION["id"]));
            }
        }
    }

}