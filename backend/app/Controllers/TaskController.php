<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends CoreController
{
        /**
     * Returns the list of tasks
     */
    public function list()
    {
        $tasks = Task::findAll();
        http_response_code(200);
        echo json_encode($tasks);
    }

    /**
     * Returns a Task according to its id
     */
    public function item($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            http_response_code(200);
            echo json_encode($task);
        } else {
            http_response_code(404);
            echo json_encode("Tâche non trouvée, veuillez saisir un id correct");
        }
    }

    /**
     * Allows you to add a task
     */
    public function add()
    {
        $newTask = json_decode(file_get_contents("php://input"), true);

        $task = new Task();
        $task->setUserId($newTask['user_id']);
        $task->setTitle($newTask['title']);
        $task->setDescription($newTask['description']);

        $task->insert();
        http_response_code(201);
        echo json_encode("Tâche : '" . $task->getTitle() . "' ajoutée.");
    }

    /**
     * Allows the deletion of a task according to his id
     */
    public function delete($taskId)
    {
        $taskToDelete = Task::find($taskId);

        if ($taskToDelete) {
            Task::delete($taskId);
            header("Access-Control-Allow-Origin: http://localhost");
            header("Content-Type: application/json");
    
            http_response_code(200);
            echo json_encode("Tâche supprimée");
        } else {
            header("Access-Control-Allow-Origin: http://localhost");
            header("Content-Type: application/json");

            http_response_code(404);
            echo json_encode("Tâche non trouvée, veuillez saisir un id correct");
        }
    }

}