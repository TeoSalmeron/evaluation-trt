<?php

namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // We set into "$class" the concerned namespace

        // Remove "App\"
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // Remove "\" and replace them with "/"
        $class = str_replace('\\', '/', $class);

        $file = __DIR__ . '/' . $class . '.php';

        // Check if file exists
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
