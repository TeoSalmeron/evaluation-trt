<?php

namespace App\Controllers;

abstract class Controller
{
    /**
     * Display a view
     * 
     * @param string $file
     * @param array $data
     */
    public function render(string $file, array $data = [], array $script = null)
    {
        // Get datas and extract them into variables
        extract($data);

        // Start output buffer
        ob_start();

        require_once ROOT . '/Views/' . $file . '.php';


        if (isset($script) && !is_null($script)) {
            foreach ($script as $s) {
                echo '<script src="script/'.$s.'.js" language="javascript"></script>';
            }
        }

        $content = ob_get_clean();
        // End output buffer

        // Generate template
        require_once ROOT . '/Views/default.php';
    }
}
