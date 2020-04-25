<?php

use Selective\Config\Configuration;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use App\Middleware\CorsMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // CORS middleware
    $app->add(CorsMiddleware::class);

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
};