<?php

namespace Todo\Admin\repositories;

use PDO;
use Todo\Admin\interfaces\ICategoryRepository;
use Todo\Admin\models\Category;

class CategoryRepository implements ICategoryRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT id, name, color FROM categories");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): bool | array {
        $stmt = $this->db->prepare("SELECT id, name, color
                                    FROM categories
                                    WHERE id = :id");

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(Category $category): bool {
        $stmt = $this->db->prepare("INSERT INTO categories (name, color)
                                    VALUES (:name, :color)");

        return $stmt->execute([
            ":name" => $category->getName(),
            ":color" => $category->getColor()
        ]);
    }

    public function update(Category $category): bool {
        $stmt = $this->db->prepare("UPDATE categories SET name = :name, color = :color
                                    WHERE id = :id");

        return $stmt->execute([
            ":id" => $category->getId(),
            ":name" => $category->getName(),
            ":color" => $category->getColor()
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}