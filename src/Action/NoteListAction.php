<?php

namespace App\Action;

use App\Domain\Note\Data\NoteData;
use App\Domain\Note\Service\NoteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class NoteListAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $userId = 1; // hardcoded because of test task

        // Get note list for current user
        $noteList = $this->noteService->getNoteList($userId);

        // Transform the result into the JSON representation
        $noteTransformedList = [];

        foreach($noteList as $note) {
            $result = [
                'id' => $note->id,
                'title' => $note->title,
                'text' => $note->text,
                'user_id' => $note->userId,
                'created' => $note->created,
                'updated' => $note->updated
            ];
            $noteTransformedList[] = $result;
        }

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($noteTransformedList));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}