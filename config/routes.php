<?php

use Slim\App;
use App\Action\HomeAction;
use App\Action\NoteCreateAction;

return function (App $app) {
    $app->get('/', HomeAction::class);

    // Post (insert)
    $app->post('/notes', NoteCreateAction::class);
};
