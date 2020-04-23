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
        $params = [
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

        $this->connection->prepare($sql)->execute($params);

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
        $params = [
            'id' => $noteId,
        ];

        $sql = "DELETE FROM notes
                WHERE id=:id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->rowCount() ? true : false;
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
        $params = [
            'id' => $noteId,
        ];

        $sql = "SELECT * FROM notes
                WHERE id=:id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch();

        $note = new NoteData();
        $note->id = $data['id'];
        $note->title = $data['title'];
        $note->text = $data['text'];
        $note->userId = $data['user_id'];
        $note->created = $data['created'];
        $note->updated = $data['updated'];

        return $note;
    }

    /**
     * Select all notes by user Id.
     *
     * @param int $noteId The note Id
     *
     * @return Array The array of note objects
     */
    public function getNoteList(int $userId): Array
    {
        $params = [
            'user_id' => $userId,
        ];

        $sql = "SELECT * FROM notes
                WHERE user_id=:user_id
                ORDER BY created ASC";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetchAll();

        $noteList = [];
        foreach($data as $row) {
            $note = new NoteData();
            $note->id = $row['id'];
            $note->title = $row['title'];
            $note->text = $row['text'];
            $note->userId = $row['user_id'];
            $note->created = $row['created'];
            $note->updated = $row['updated'];
            $noteList[] = $note;
        }

        return $noteList;
    }
}