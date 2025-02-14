<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\Todo;

interface ITodoRepository {
    public function getAll();
    public function getById(int $id);
    public function create(Todo $todo);
    public function update(int $id, Todo $todo);
    public function delete(int $id);
}