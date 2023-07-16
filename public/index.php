<?php

session_start();

// Define root folder
define('ROOT', dirname(__DIR__));

// Import namespaces
use App\Autoloader;
use App\Core\Router;

// Import autoloader
require_once(ROOT . '/Autoloader.php');
Autoloader::register();

// New instance of Router
$app = new Router();

// Start application
$app->start();
