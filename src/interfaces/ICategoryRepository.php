<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\Category;

interface ICategoryRepository {
    public function getAll(int $user_id): array;
    public function getById(int $id, int $user_id): bool | array;
    public function create(Category $category): bool;
    public function update(Category $category): bool;
    public function delete(int $id, int $user_id): bool;
}