<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// If .htaccess file is not present, show error message
if (!file_exists('.htaccess')) {
    echo 'The .htaccess file is missing. Please make sure that the .htaccess file is present in the public directory.';
    exit;
}

// Define the base path for the application, so that we can use it in the future (e.g. for deployment)
$BASE_PATH = __DIR__.'/..';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $BASE_PATH.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Check if environment is missing
if (!file_exists($BASE_PATH.'/.env')) {
    if (!strpos($_SERVER['REQUEST_URI'], 'pre-setup') !== false) {
        header('Location: /pre-setup.html');
        exit;
    }
}

// Register the Composer autoloader...
require $BASE_PATH.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once $BASE_PATH.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
