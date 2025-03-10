<?php
namespace Todo\Admin\services;

use Todo\Admin\factories\TodoFactory;
use Todo\Admin\repositories\TodoRepository;

class TodoService {
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository) {
        $this->todoRepository = $todoRepository;
    }

    public function getAllTodos(int $user_id, ?array $status = null) {
        return $this->todoRepository->getAll($user_id, $status);
    }

    public function getTodoById(int $id, int $user_id) {
        return $this->todoRepository->getById($id, $user_id);
    }

    public function createTodo(array $data) {

        $todo = TodoFactory::createFromArray($data);

        return $this->todoRepository->create($todo);
    }

    public function updateTodo(array $data) {
        $todo = $this->getTodoById($data['id'], $data['user_id']);

        if(!$todo) {
            return false;
        }

        $todo = TodoFactory::createFromArray($todo);

        if(isset($data['title'])) {
            $todo->setTitle($data['title']);
        }

        if(isset($data['priority'])) {
            $todo->setPriority($data['priority']);
        }

        if(isset($data['status'])) {
            $todo->setStatus($data['status']);
        }

        if(isset($data['completed'])) {
            $todo->setCompleted($data['completed']);
        }

        if(isset($data['category_id'])) {
            $todo->setCategoryId($data['category_id']);
        }

        $todo->setUpdatedAt(date('Y-m-d H:i:s'));
        $todo->setDescription($data['description']);

        return $this->todoRepository->update($todo);
    }
}