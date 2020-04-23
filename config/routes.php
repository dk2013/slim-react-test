<?php

use Slim\App;
use App\Action\HomeAction;
use App\Action\NoteCreateAction;
use App\Action\NoteDeleteAction;

return function (App $app) {
    $app->get('/', HomeAction::class);

    // Post (insert)
    $app->post('/notes', NoteCreateAction::class);

    // Delete
    $app->delete('/notes/{id}', NoteDeleteAction::class);
};
