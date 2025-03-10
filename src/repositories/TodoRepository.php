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

    public function getAll(int $user_id, ?array $statuses = null): array {
        $query = "SELECT id, title, description, priority, status, completed, user_id, category_id
                FROM todos WHERE user_id = :user_id";

        $params = [":user_id" => $user_id];

        if (!empty($statuses)) {
            $statusPlaceholders = [];
            foreach ($statuses as $index => $status) {
                $paramName = ":status$index";
                $statusPlaceholders[] = $paramName;
                $params[$paramName] = $status;
            }
            $query .= " AND status IN (" . implode(',', $statusPlaceholders) . ")";
        }

        $stmt = $this->db->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id, int $user_id): bool|array {
        $stmt = $this->db->prepare("SELECT id, title, description, priority, status, completed, created_at, updated_at, completed_at, user_id, category_id
                                    FROM todos WHERE id = :id AND user_id = :user_id");

        $stmt->execute([
            ":id" => $id,
            ":user_id" => $user_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(Todo $todo): bool {
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

    public function update(Todo $todo): bool {
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
}