<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class User extends CoreModel
{
    private $name;
    private $email;

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method used to retrieve all the records from the User table
     * @return User[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Method used to retrieve a record from the User table according to the Id
     * @return User
     */
    public static function find($userId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT `user`.`id`,`name`, `email`, `title`, `description`, `creation_date`, `status` FROM `user`
                LEFT JOIN `task` on `user`.`id`=`task`.`user_id`
                WHERE `user`.`id` =' . $userId;
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Method for adding an entry
     */
    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = 'INSERT INTO `user` (`name`, `email`)
                VALUES (
                :name,
                :email)';
        $request = $pdo->prepare($sql);
        $insertedRows = $request->execute([
            ':name' => $this->getName(),
            ':email' => $this->getEmail()
        ]);
        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * Method to delete an entry
     */
    public static function delete($userId)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `user` WHERE `id`=' . $userId;
        $pdoStatement = $pdo->exec($sql);

        return $pdoStatement;
    }
}
