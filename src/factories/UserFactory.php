<?php

namespace Todo\Admin\factories;

use Todo\Admin\models\User;

class UserFactory {
    public static function createFromArray(array $data): User {
        return new User(
            $data['id'],
            $data['name'],
            $data['lastName'],
            $data['email'],
            $data['password'],
            $data['profilePicture'],
            $data['created_at'] ?? date('Ymd'),
            $data['updated_at'] ?? date('Ymd')
        );
    }
}