<?php

namespace Todo\Admin\repositories;

use Todo\Admin\config\Database;
use Todo\Admin\interfaces\ITodoRepository;
use Todo\Admin\models\Todo;
use PDO;


class TodoRepository implements ITodoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM todos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM todos
                                        WHERE id = :id");
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(Todo $todo)
    {
        $stmt = $this->db->prepare("INSERT INTO todos (title, completed)
                                    VALUES (:title, :completed)");
        return $stmt->execute([
            "title" => $todo->getTitle(),
            "completed" => $todo->isCompleted()
        ]);
    }

    public function update(int $id, Todo $todo) {
        $stmt = $this->db->prepare("UPDATE todos
                                    SET title = :title, completed = :completed
                                    WHERE id = :id");

        $stmt->execute([
            "title" => $todo->getTitle(),
            "completed" => $todo->isCompleted(),
            "id" => $id
        ]);
    }

    public function delete(int $id) {
        $stmt = $this->db->prepare("DELETE FROM todos
                                    WHERE id = :id");

        $stmt->execute([
            "id" => $id
        ]);
    }
}