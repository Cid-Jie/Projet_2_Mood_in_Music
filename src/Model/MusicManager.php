<?php

namespace App\Model;

class MusicManager extends AbstractManager
{
    public const TABLE = 'music';
    public const JOINED_TABLE = 'musical_genre';

    /**
     * Get all informations for musics from database.
     */
    public function selectAllList()
    {
        $query = 'SELECT ' . self::TABLE . '.id, title, author, source, music_image, '
        . self::JOINED_TABLE . '.genre_name 
        FROM ' . self::TABLE . '
        INNER JOIN ' . self::JOINED_TABLE . ' ON ' . self::TABLE . '.musical_genre_id=' . self::JOINED_TABLE . '.id
        ORDER BY music.title ASC;';

        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Get all genre from database.
     */
    public function selectAllGenre()
    {
        $query = 'SELECT * FROM ' . self::JOINED_TABLE . ';';

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneById(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare('SELECT ' . self::TABLE . '.id, title, author, source,
        music_image, musical_genre_id, ' . self::JOINED_TABLE . '.genre_name
        FROM ' . self::TABLE . '
        INNER JOIN ' . self::JOINED_TABLE . '
        ON ' . self::TABLE . '.musical_genre_id=' . self::JOINED_TABLE . '.id
        WHERE ' . self::TABLE . '.id=:id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * Insert new item in database
     */
    public function insert(array $music): int
    {
        $query = 'INSERT INTO ' . self::TABLE . '
        (`title`,`author`,`source`,`musical_genre_id`, `music_image`, `number_vote`) 
        VALUES (:title, :author, :source, :musical_genre_id, :music_image, 0)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $music['title'], \PDO::PARAM_STR);
        $statement->bindValue('author', $music['author'], \PDO::PARAM_STR);
        $statement->bindValue('source', $music['source'], \PDO::PARAM_STR);
        $statement->bindValue('musical_genre_id', $music['musical_genre_id'], \PDO::PARAM_STR);
        $statement->bindValue('music_image', $music['music_image'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $music): bool
    {
        $query = 'UPDATE ' . self::TABLE .
        ' SET `title` = :title, `author` = :author, `source` = :source,
        `musical_genre_id` = :musical_genre_id, `music_image` = :music_image WHERE `id`=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $music['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $music['title'], \PDO::PARAM_STR);
        $statement->bindValue('author', $music['author'], \PDO::PARAM_STR);
        $statement->bindValue('source', $music['source'], \PDO::PARAM_STR);
        $statement->bindValue('musical_genre_id', $music['musical_genre_id'], \PDO::PARAM_STR);
        $statement->bindValue('music_image', $music['music_image'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    /**
     * Moves data from `number_vote` to `old_number_vote`
     */
    public function movesVotesInDB()
    {
        $update = $this->pdo->prepare("UPDATE " . static::TABLE . " SET `old_number_vote` = `number_vote`");
        $update->execute();
        $delete = $this->pdo->prepare("UPDATE " . static::TABLE . " SET `number_vote` = 0 ");
        $delete->execute();
    }
}
