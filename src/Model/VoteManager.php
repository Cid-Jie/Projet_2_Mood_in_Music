<?php

namespace App\Model;

class VoteManager extends AbstractManager
{
    public const ROUND_TABLE = 'dates';
    public const TABLE = 'music';
    public const JOINED_TABLE = 'musical_genre';

    /**
     * Insert new dates into DB
     */
    public function insert(string $startDate, string $endDate)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::ROUND_TABLE . " (start_date, end_date) 
        VALUES ('$startDate', '$endDate')");
        $statement->execute();
    }

     /**
     * Get all dates from database
     */
    public function selectAllDates()
    {
        $query = 'SELECT `start_date`, `end_date` FROM ' . static::ROUND_TABLE . ' ORDER BY id DESC LIMIT 1';
        return $this->pdo->query($query)->fetch();
    }

    /**
     * Get last end_date from database
     */
    public function selectEndDate()
    {
        $query = 'SELECT `end_date` FROM ' . static::ROUND_TABLE . ' ORDER BY id DESC LIMIT 1';
        return $this->pdo->query($query)->fetch();
    }

    public function selectVoteById($genreId)
    {
        if ($genreId == 7) {
            $query = 'SELECT ' . self::TABLE . '.id, title, author, source, music_image, number_vote, '
            . self::JOINED_TABLE . '.genre_name
            FROM ' . self::TABLE . '
            INNER JOIN ' . self::JOINED_TABLE . ' ON ' . self::TABLE . '.musical_genre_id=' . self::JOINED_TABLE . '.id
            WHERE number_vote != 0
            ORDER BY number_vote DESC
            LIMIT 0,3;';
        } else {
            $query = 'SELECT ' . self::TABLE . '.id, title, author, source, music_image, number_vote, '
            . self::JOINED_TABLE . '.genre_name
            FROM ' . self::TABLE . '
            INNER JOIN ' . self::JOINED_TABLE . ' ON ' . self::TABLE . '.musical_genre_id=' . self::JOINED_TABLE . '.id
            WHERE ' . self::TABLE . '.musical_genre_id=' . $genreId . ' AND number_vote != 0
            ORDER BY number_vote DESC
            LIMIT 0,3;';
        }
        return $this->pdo->query($query)->fetchAll();
    }

    public function incrementVote(array $voteMusic): bool
    {
        $query = 'UPDATE ' . self::TABLE . ' SET `number_vote` = :number_vote +1 WHERE `id`=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $voteMusic['id'], \PDO::PARAM_INT);
        $statement->bindValue('number_vote', $voteMusic['number_vote'], \PDO::PARAM_INT);
        return $statement->execute();
    }
}
