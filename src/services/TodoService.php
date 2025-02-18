<?php
namespace Todo\Admin\services;

use Exception;
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
            0,
            $data['user_id'],
            $data['category_id']
        );

        return $this->todoRepository->create($todo);
    }

    public function updateTodo(array $data) {
        $todo = TodoRepository::fromArray($this->getTodoById($data['id']));

        if(!empty($todo)) {
            if(isset($data['title'])) {
                $todo->setTitle($data['title']);
            }

            if(isset($data['priority'])) {
                $todo->setPriority($data['priority']);
            }

            if(isset($data['status'])) {
                $todo->setStatus($data['status']);
            }

            if(!$todo->isCompleted() && isset($data['completed']) && $data['completed'] === true) {
                $todo->setCompletedAt(date('Y-m-d H:i:s'));
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
        } else {
            throw new Exception("The to-do with id" . $data['id'] . "doesn't exist.");
        }
    }
}