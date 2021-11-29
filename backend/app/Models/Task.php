<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Task extends CoreModel
{
    private $userId;
    private $title;
    private $description;
    private $creationDate;
    private $status;

    public function __construct()
    {
        $this->creationDate = date("Y-m-d H:i:s");
        $this->status=0;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of creationDate
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

        /**
     * Method used to retrieve all the records from the Task table
     * @return Task[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `task`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Method used to retrieve a record from the User table according to the Id
     * @return Task
     */
    public static function find($taskId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `task`WHERE `id`=' . $taskId;
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
        $sql = 'INSERT INTO `task` (`user_id`,`title`, `description`, `creation_date`, `status`)
                VALUES (
                :user_id,
                :title,
                :description,
                :creation_date,
                :status)';
        $request = $pdo->prepare($sql);
        $insertedRows = $request->execute([
            ':user_id' => $this->getUserId(),
            ':title' => $this->getTitle(),
            ':description'=>$this->getDescription(),
            ':creation_date'=>$this->getCreationDate(),
            ':status'=>$this->getStatus()
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
    public static function delete($taskId)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `task` WHERE `id`=' . $taskId;
        $pdoStatement = $pdo->exec($sql);

        return $pdoStatement;
    }

}
