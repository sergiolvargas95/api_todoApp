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
        $stmt = $this->db->prepare("SELECT title, description, priority, status, completed, user_id, category_id
                                    FROM todos WHERE id = :id");

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function update(int $id, Todo $todo) {

    }

    public function delete(int $id) {

    }
}