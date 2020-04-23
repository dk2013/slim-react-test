<?php

namespace App\Action;

use App\Domain\Note\Service\NoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NoteDeleteAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Array $args)
    {
        // Collect input from the URL args
        $noteId = intval($args['id']);

        // Invoke the Domain with inputs and retain the result
        $status = $this->noteService->deleteNote($noteId);

        // Transform the result into the JSON representation
        $result = [
            'status' => (($status == true) ? 'ok' : 'fail' )
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}