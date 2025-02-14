<?php

namespace Todo\Admin\controllers;

use Exception;
use Todo\Admin\services\TodoService;

class TodoController {
    private $todoService;

    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }

    public function getAll() {
        echo json_encode($this->todoService->getAllTodos());
    }

    public function getById($id) {
        echo json_encode($this->todoService->getTodoById($id));
    }

    public function create($title) {
        try {
            $this->todoService->createTodo($title);
            echo json_encode(["mensaje" => "To-Do creado con éxito"]);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function update($id, $title, $completed) {
        $this->todoService->updateTodo($id, $title, $completed);
        echo json_encode(["mensaje" => "To-Do actualizado"]);
    }

    public function delete($id) {
        $this->todoService->deleteTodo($id);
        echo json_encode(["mensaje" => "To-Do eliminado"]);
    }
}