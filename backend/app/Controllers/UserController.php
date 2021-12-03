<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class UserController extends CoreController
{
    /**
     * Returns the list of users
     */
    public function list()
    {
        $users = User::findAll();
        http_response_code(200);
        echo json_encode($users);
    }

    /**
     * Returns a User according to its id
     */
    public function item($userId)
    {
        $user = User::find($userId);
        if ($user) {
            http_response_code(200);
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode("Utilisateur non trouvé, veuillez saisir un id correct");
        }
    }

    /**
     * Allows you to add a user
     */
    public function add()
    {
        $newUser = json_decode(file_get_contents("php://input"), true);

        $user = new User();
        $user->setName($newUser['name']);
        $user->setEmail($newUser['email']);

        $user->insert();
        http_response_code(201);
        echo json_encode("Utilisateur : " . $user->getName() . " ajouté.");
    }

    /**
     * Allows the deletion of a user according to his id
     */
    public function delete($userId)
    {
        $userToDelete = User::find($userId);

        if ($userToDelete) {
            User::delete($userId);
            http_response_code(200);
            echo json_encode("Utilisateur supprimé");
        } else {
            http_response_code(404);
            echo json_encode("Utilisateur non trouvé, veuillez saisir un id correct");
        }
    }

    /**
     * Allows the addition of a task by a user according to his id
     */
    public function addTask($userId)
    {
        $newTaskByUser= json_decode(file_get_contents("php://input"), true);

        $task = new Task($userId);
        $task->setUserId($userId);
        $task->setTitle(ucfirst($newTaskByUser['title']));
        $task->setDescription(ucfirst($newTaskByUser['description']));

        $task->insert();
        http_response_code(201);
        echo json_encode("Nouvelle tâche : '" . $task->getTitle() . "' crée.");
    }
}
