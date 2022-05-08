<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function getUserByPseudo($userName)
    {
        $query = 'SELECT * FROM ' . static::TABLE . " WHERE pseudo = :pseudo";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('pseudo', $userName, \PDO::PARAM_STR_CHAR);
        $statement->execute();
        return $statement->fetch();
    }
}
