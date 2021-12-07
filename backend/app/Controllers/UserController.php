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
        header("Access-Control-Allow-Origin: http://localhost");
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($users);
    }

    /**
     * Returns a User according to its id
     */
    public function item($userId)
    {
        $user = User::find($userId);
        header("Access-Control-Allow-Origin: http://localhost");
        header("Content-Type: application/json");

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

        // $user->setName($newUser['name']);
        if (!empty($newUser['name'])) {
            $user->setName($newUser['name']);
            if (filter_var($newUser['email'], FILTER_VALIDATE_EMAIL)) {
                $user->setEmail($newUser['email']);
            } else {
                http_response_code(500);
                echo json_encode("L'adresse mail fournie n'est pas valide, l'ajout a échoué.");
            }
            $user->insert();
            header("Access-Control-Allow-Origin: http://localhost");
            header("Content-Type: application/json");

            http_response_code(201);
            echo json_encode("Utilisateur : " . $user->getName() . " ajouté.");
        } else {
            http_response_code(500);
            echo json_encode("Le nom d'utilisateur n'a pas été fourni, l'ajout à échoué.");
        }
    }

    /**
     * Allows the deletion of a user according to his id
     */
    public function delete($userId)
    {
        $userToDelete = User::find($userId);

        if ($userToDelete) {
            User::delete($userId);
            header("Access-Control-Allow-Origin: http://localhost");
            header("Content-Type: application/json");

            http_response_code(200);
            echo json_encode("Utilisateur supprimé");
        } else {
            header("Access-Control-Allow-Origin: http://localhost");
            header("Content-Type: application/json");

            http_response_code(404);
            echo json_encode("Utilisateur non trouvé, veuillez saisir un id correct");
        }
    }

    /**
     * Allows the addition of a task by a user according to his id
     */
    public function addTask($userId)
    {
        $newTaskByUser = json_decode(file_get_contents("php://input"), true);

        $task = new Task($userId);
        $task->setUserId($userId);
        $task->setTitle(ucfirst($newTaskByUser['title']));
        $task->setDescription(ucfirst($newTaskByUser['description']));

        $task->insert();
        http_response_code(201);
        echo json_encode("Nouvelle tâche : '" . $task->getTitle() . "' crée.");
    }
}
