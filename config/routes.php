<?php

use Slim\App;
use App\Action\HomeAction;
use App\Action\NoteCreateAction;
use App\Action\NoteDeleteAction;
use App\Action\NoteShowAction;
use App\Action\NoteListAction;

return function (App $app) {
    $app->get('/', HomeAction::class);

    // API:
    // Get
    $app->get('/notes', NoteListAction::class);
    $app->get('/notes/{id}', NoteShowAction::class);

    // Post (insert)
    $app->post('/notes', NoteCreateAction::class);

    // Delete
    $app->delete('/notes/{id}', NoteDeleteAction::class);
};
