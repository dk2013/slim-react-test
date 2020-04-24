<?php

namespace App\Action;

use App\Domain\Note\Data\NoteData;
use App\Domain\Note\Service\NoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NoteShowAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Array $args)
    {
        $userId = 1; // hardcoded because of test task

        // Collect input from the URL args
        $noteId = intval($args['id']);

        // Get note by Id
        $note = $this->noteService->getNote($noteId);

        // Transform the result into the JSON representation
        $result = [
            'id' => $note->id,
            'title' => $note->title,
            'text' => $note->text,
            'user_id' => $note->userId,
            'created' => $note->created,
            'updated' => $note->updated
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}