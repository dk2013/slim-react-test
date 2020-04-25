<?php

use Slim\App;
use App\Action\HomeAction;
use App\Action\NoteCreateAction;
use App\Action\NoteDeleteAction;
use App\Action\NoteShowAction;
use App\Action\NoteListAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

return function (App $app) {
    $app->get('/', HomeAction::class);

    // API:
    // Get
    $app->get('/notes', NoteListAction::class);
    $app->get('/notes/{id}', NoteShowAction::class);

    // Post (insert)
    $app->post('/notes', NoteCreateAction::class);
    // Allow preflight requests for /notes
    $app->options('/notes', function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response;
    });

    // Delete
    $app->delete('/notes/{id}', NoteDeleteAction::class);
};
