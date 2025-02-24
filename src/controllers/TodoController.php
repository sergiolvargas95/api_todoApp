<?php

namespace Todo\Admin\controllers;

use Todo\Admin\models\Todo;
use Todo\Admin\services\TodoService;

class TodoController {
    private $todoService;

    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }

    public function getAll(int $user_id) {
        return json_encode($this->todoService->getAllTodos($user_id));
    }

    public function getById(int $id, int $user_id) {
        return json_encode($this->todoService->getTodoById($id, $user_id));
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['title'], $data['priority'], $data['status'], $data['user_id'], $data['completed'])) {
            http_response_code(400);
            return json_encode(["error" => "Invalid Data"]);
        }

        $success = $this->todoService->createTodo($data);

        if ($success) {
            http_response_code(201);
            return json_encode(["message" => "To-Do created Succesfully"]);
        } else {
            http_response_code(500);
            return json_encode(["error" => "Error creating To-Do"]);
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['title'], $data['priority'], $data['status'], $data['user_id'], $data['completed'])) {
            http_response_code(400);
            return json_encode(["error" => "Invalid Data"]);
        }

        $success = $this->todoService->updateTodo($data);

        if ($success) {
            http_response_code(201);
            return json_encode(["message" => "To-Do updated Succesfully"]);
        } else {
            http_response_code(500);
            return json_encode(["error" => "Error updating To-Do"]);
        }
    }
}