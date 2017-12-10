<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, App-Token');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('vendor/autoload.php');
    require('app/Bootstrap.php');
    
    $app = new App();
    $app->boot();
    $app->run();