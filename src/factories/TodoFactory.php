<?php

namespace Todo\Admin\factories;

use Todo\Admin\models\Todo;

class TodoFactory {
    public static function createFromArray(array $data): Todo {
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