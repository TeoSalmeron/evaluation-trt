<?php

namespace App\Core;

use App\Controllers\DefaultController;

class Router
{
    public function start()
    {
        // Get URL
        $uri = $_SERVER['REQUEST_URI'];

        // Check that URL is not empty and ends with a "/"
        if (!empty($uri) && $uri != '/' && $uri[-1] === '/') {

            // Remove "/"
            $uri = substr($uri, 0, -1);

            // Permanent redirection
            http_response_code(301);

            // Redirect towards the URL 
            header('Location : ' . $uri);
            exit;
        }

        // Explode parameters and set them into $params
        $params = explode('/', $_GET['p']);

        // If at least one parameter exists
        if ($params[0] != "") {

            // Save first parameter into $controller, check if first parameter contains "-", format controller
            $controller = strtolower($params[0]);
            $controller_array = explode("-", $controller);
            $controller = "";
            foreach ($controller_array as $c) {
                $controller .= ucfirst($c);
            }


            // Check if controller exists
            if (!file_exists(ROOT . '/Controllers/' . $controller . 'Controller.php')) {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            } else {
                $controller = '\\App\\Controllers\\' . $controller . 'Controller';

                array_shift($params);

                // Check if second parameters exists, if not, redirect to "index"
                $action = isset($params[0]) ? array_shift($params) : 'index';

                // New Controller
                $controller = new $controller();

                // Check if method exists
                if (!method_exists($controller, $action)) {
                    http_response_code(404);
                    echo "La page recherchée n'existe pas";
                } else {

                    // If there are any parameters left, call this method and send them parameters, else send empty parameters
                    isset($params[0]) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
                }
            }
        } else {

            // No parameters are sent
            // We create new default controller (landing page)
            $controller = new DefaultController();

            $controller->index();
        }
    }
}
