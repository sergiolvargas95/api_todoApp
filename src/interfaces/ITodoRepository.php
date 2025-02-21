<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\Todo;

interface ITodoRepository {
    public function getAll(int $user_id): array;
    public function getById(int $id, int $user_id): bool|array;
    public function create(Todo $todo): bool;
    public function update(Todo $todo): bool;
}