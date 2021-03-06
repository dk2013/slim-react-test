<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Data\NoteData;
use App\Domain\Note\Repository\NoteRepository;
use InvalidArgumentException;

/**
 * Service.
 */
final class NoteService
{
    /**
     * @var NoteRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param NoteRepository $repository The repository
     */
    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new note.
     *
     * @param NoteData $note The note data
     *
     * @throws InvalidArgumentException
     *
     * @return int The new note ID
     */
    public function createNote(NoteData $note): int
    {
        // Validation
        if (empty($note->title) || empty($note->text)) {
            throw new InvalidArgumentException('Fields required');
        }

        // Insert note
        $noteId = $this->repository->insertNote($note);

        // Note created successfully

        return $noteId;
    }

    /**
     * Delete a note.
     *
     * @param int $note The note Id
     *
     * @throws InvalidArgumentException
     *
     * @return bool Status of operation
     */
    public function deleteNote(int $noteId): bool
    {
        // Validation
        if (empty($noteId)) {
            throw new InvalidArgumentException('Wrong note Id');
        }

        // Delete note
        $status = $this->repository->deleteNote($noteId);

        return $status;
    }

    /**
     * Get a note.
     *
     * @param int $note The note Id
     *
     * @throws InvalidArgumentException
     *
     * @return NoteData The note object
     */
    public function getNote(int $noteId): NoteData
    {
        // Validation
        if (empty($noteId)) {
            throw new InvalidArgumentException('Wrong note Id');
        }

        // Get note
        $note = $this->repository->getNote($noteId);

        return $note;
    }

    /**
     * Get a note list for user.
     *
     * @param int $userId The user Id
     * 
     * @throws InvalidArgumentException
     *
     * @return Array The array of note objects
     */
    public function getNoteList(int $userId): Array
    {
        // Validation
        if (empty($userId)) {
            throw new InvalidArgumentException('Wrong user Id');
        }

        // Get array of note objects
        $noteList = $this->repository->getNoteList($userId);

        return $noteList;
    }
}
