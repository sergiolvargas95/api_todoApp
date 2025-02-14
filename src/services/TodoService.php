<?php

namespace Todo\Admin\services;

use Exception;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\models\Todo;

class TodoService {
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository) {
        $this->todoRepository = $todoRepository;
    }

    public function getAllTodos() {
        return $this->todoRepository->getAll();
    }

    public function getTodoById($id) {
        return $this->todoRepository->getById($id);
    }

    public function createTodo($title) {
        if (empty($title)) {
            throw new Exception("El título no puede estar vacío.");
        }
        $todo = new Todo(null, $title, false);
        return $this->todoRepository->create($todo);
    }

    public function updateTodo($id, $title, $completed) {
        $todo = new Todo($id, $title, $completed);
        return $this->todoRepository->update($id, $todo);
    }

    public function deleteTodo($id) {
        return $this->todoRepository->delete($id);
    }
}