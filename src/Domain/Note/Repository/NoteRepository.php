<?php

namespace App\Domain\Note\Repository;

use App\Domain\Note\Data\NoteData;
use PDO;

/**
 * Repository.
 */
class NoteRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert note row.
     *
     * @param NoteData $note The note
     *
     * @return int The new note ID
     */
    public function insertNote(NoteData $note): int
    {
        $row = [
            'title' => $note->title,
            'text' => $note->text,
            'user_id' => $note->userId,
            'created' => $note->created,
            'updated' => $note->updated,
        ];

        $sql = "INSERT INTO notes SET 
                title=:title, 
                text=:text, 
                user_id=:user_id,
                created=:created,
                updated=:updated";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}