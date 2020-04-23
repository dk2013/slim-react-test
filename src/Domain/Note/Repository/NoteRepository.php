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

        return (int) $this->connection->lastInsertId();
    }

    /**
     * Delete note row.
     *
     * @param int $noteId The note Id
     *
     * @return bool Status of operation
     */
    public function deleteNote(int $noteId): bool
    {
        $row = [
            'id' => $noteId,
        ];

        $sql = "DELETE FROM notes
                WHERE id=:id";

        $q = $this->connection->prepare($sql);
        $q->execute($row);

        return (bool) $q->rowCount() ? true : false;
    }

    /**
     * Select note row.
     *
     * @param int $noteId The note Id
     *
     * @return NoteData The note object
     */
    public function getNote(int $noteId): NoteData
    {
        $row = [
            'id' => $noteId,
        ];

        $sql = "SELECT * FROM notes
                WHERE id=:id";

        $q = $this->connection->prepare($sql);
        $q->execute($row);
        $data = $q->fetch();

        $note = new NoteData();
        $note->id = $data['id'];
        $note->title = $data['title'];
        $note->text = $data['text'];
        $note->userId = $data['user_id'];
        $note->created = $data['created'];
        $note->updated = $data['updated'];

        return $note;
    }
}