<?php

namespace Todo\Admin\repositories;

use PDO;
use Todo\Admin\interfaces\ITodoRepository;
use Todo\Admin\models\Todo;

class TodoRepository implements ITodoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT id, title, description, priority, status, completed, user_id, category_id
                                    FROM todos");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id) {
        $stmt = $this->db->prepare("SELECT id, title, description, priority, status, completed, created_at, updated_at, completed_at, user_id, category_id
                                    FROM todos WHERE id = :id");

        $stmt->execute([
            ":id" => $id
        ]);

        $todo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->fromArray($todo);
    }

    public function create(Todo $todo) {
        $stmt = $this->db->prepare("INSERT INTO todos (title, description, priority, status, completed, created_at, updated_at, completed_at, user_id, category_id)
                                    VALUES (:title, :description, :priority, :status, :completed, :created_at, :updated_at, :completed_at, :user_id, :category_id)");

        return $stmt->execute([
            ":title" => $todo->getTitle(),
            ":description" => $todo->getDescription(),
            ":priority" => $todo->getPriority(),
            ":status" => $todo->getStatus(),
            ":completed" => $todo->isCompleted(),
            ":created_at" => $todo->getCreatedAt(),
            ":updated_at" => $todo->getUpdatedAt(),
            ":completed_at" => $todo->getCompletedAt(),
            ":user_id" => $todo->getUserId(),
            ":category_id" => $todo->getCategoryId(),
        ]);
    }

    public function update(Todo $todo) {
        $stmt = $this->db->prepare("UPDATE todos
                                    SET title = :title,
                                        description = :description,
                                        priority = :priority,
                                        status = :status,
                                        completed = :completed,
                                        updated_at = :updated_at,
                                        completed_at = :completed_at,
                                        category_id = :category_id
                                    WHERE id = :id AND user_id = :user_id");

        return $stmt->execute([
            ":id" => $todo->getId(),
            ":title" => $todo->getTitle(),
            ":description" => $todo->getDescription(),
            ":priority" => $todo->getPriority(),
            ":status" => $todo->getStatus(),
            ":completed" => $todo->isCompleted(),
            ":updated_at" => $todo->getUpdatedAt(),
            ":completed_at" => $todo->getCompletedAt(),
            ":category_id" => $todo->getCategoryId(),
            ":user_id" => $todo->getUserId()
        ]);
    }

    public function delete(int $id) {

    }

    public function fromArray($data) {
        return new Todo(
            $data['id'],
            $data['title'],
            $data['description'],
            $data['priority'],
            $data['status'],
            $data['completed'],
            $data['created_at'],
            $data['updated_at'],
            $data['completed_at'],
            $data['user_id'],
            $data['category_id']
        );
    }
}