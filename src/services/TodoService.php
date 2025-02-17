<?php
namespace Todo\Admin\services;

use Todo\Admin\models\Todo;
use Todo\Admin\repositories\TodoRepository;

class TodoService {
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository) {
        $this->todoRepository = $todoRepository;
    }

    public function getAllTodos() {
        return $this->todoRepository->getAll();
    }

    public function getTodoById(int $id) {
        return $this->todoRepository->getById($id);
    }

    public function createTodo(array $data) {
        $todo = new Todo(
            null,
            $data['title'],
            $data['description'] ?? null,
            $data['priority'],
            $data['status'],
            $data['completed'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s'),
            $data['completed_at'] ?? null,
            $data['user_id'],
            $data['category_id']
        );

        return $this->todoRepository->create($todo);
    }
}