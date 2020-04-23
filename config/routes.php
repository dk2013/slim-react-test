<?php

use Slim\App;
use App\Action\HomeAction;

return function (App $app) {
    $app->get('/', HomeAction::class);
};
