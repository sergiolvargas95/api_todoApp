<?php

namespace Todo\Admin\factories;

use Todo\Admin\models\Todo;

class TodoFactory {
    public static function createFromArray(array $data, int $user_id): Todo {
        return new Todo(
            $data['id'],
            $data['title'],
            $data['description'],
            $data['priority'],
            $data['status'] ?? 'open',
            $data['completed'],
            $data['created_at'] ?? date('Ymd'),
            $data['updated_at'] ?? date('Ymd'),
            $data['completed_at'] ?? null,
            $data['user_id']  = $user_id,
            intval($data['category_id'])
        );
    }
}