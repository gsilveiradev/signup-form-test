<?php

namespace SignupFormTest;

use Symfony\Component\HttpFoundation\Request;
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/../../', 'config.env');
$dotenv->load();

require __DIR__ . '/Framework/Core.php';

Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
    
// Handle the request
$app = new Framework\Core();

// Create Routes map
$ctrPath = 'SignupFormTest\Controllers';

$app->map('GET', 'home', '/', [$ctrPath.'\SignupController', 'index']);
$app->map('POST', 'signup', '/signup', [$ctrPath.'\SignupController', 'create']);
$app->map('POST', 'signup_verify_email', '/signup/verify_email', [$ctrPath.'\SignupController', 'verifyEmail']);

$response = $app->handle($request);

$response->prepare($request);
$response->send();
