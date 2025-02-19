<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\Todo;

interface ITodoRepository {
    public function getAll(): array;
    public function getById(int $id): bool|array;
    public function create(Todo $todo): bool;
    public function update(Todo $todo): bool;
}