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

    public function getAll(int $user_id): array {
        $stmt = $this->db->prepare("SELECT DISTINCT c.id, c.name, c.color
                                    FROM categories c
                                    LEFT JOIN todos t ON c.id = t.category_id
                                    WHERE c.user_id = :user_id");

        $stmt->execute([
            ":user_id" => $user_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id, int $user_id): bool | array {
        $stmt = $this->db->prepare("SELECT id, name, color, user_id
                                    FROM categories
                                    WHERE id = :id AND user_id = :user_id");

        $stmt->execute([
            ":id" => $id,
            ":user_id" => $user_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(Category $category): bool {
        $stmt = $this->db->prepare("INSERT INTO categories (name, color, user_id)
                                    VALUES (:name, :color, :user_id)");

        return $stmt->execute([
            ":name" => $category->getName(),
            ":color" => $category->getColor(),
            ":user_id" => $category->getUserId()
        ]);
    }

    public function update(Category $category): bool {
        $stmt = $this->db->prepare("UPDATE categories SET name = :name, color = :color
                                    WHERE id = :id AND user_id = :user_id");

        return $stmt->execute([
            ":id" => $category->getId(),
            ":name" => $category->getName(),
            ":color" => $category->getColor(),
            ":user_id" => $category->getUserId()
        ]);
    }

    public function delete(int $id, int $user_id): bool {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id AND user_id = :user_id");

        return $stmt->execute([
            ":id" => $id,
            ":user_id" => $user_id
        ]);
    }
}