<?php

namespace App\Action;

use App\Domain\Note\Data\NoteData;
use App\Domain\Note\Service\NoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NoteCreateAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $userId = 1; // hardcoded because of test tesk

        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        $note = new NoteData();
        $note->title = $data['title'];
        $note->text = $data['text'];
        $note->userId = $userId;
        $note->created = date('Y-m-d H:i:s');
        $note->updated = date('Y-m-d H:i:s');

        // Invoke the Domain with inputs and retain the result
        $noteId = $this->noteService->createNote($note);

        // Transform the result into the JSON representation
        $result = [
            'note_id' => $noteId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}