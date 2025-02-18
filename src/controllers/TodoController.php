<?php

namespace Todo\Admin\controllers;

use Todo\Admin\models\Todo;
use Todo\Admin\services\TodoService;

class TodoController {
    private $todoService;

    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }

    public function getAll() {
        return json_encode($this->todoService->getAllTodos());
    }

    public function getById(int $id) {
        return json_encode($this->todoService->getTodoById($id));
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['title'], $data['priority'], $data['status'], $data['user_id'], $data['completed'])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid Data"]);
            return;
        }

        $success = $this->todoService->createTodo($data);

        if ($success) {
            http_response_code(201);
            echo json_encode(["message" => "To-Do created Succesfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error creating To-Do"]);
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['title'], $data['priority'], $data['status'], $data['user_id'], $data['completed'])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid Data"]);
            return;
        }

        $success = $this->todoService->updateTodo($data);

        if ($success) {
            http_response_code(201);
            echo json_encode(["message" => "To-Do updated Succesfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error updating To-Do"]);
        }
    }
}