<?php

use Todo\Admin\models\User;

class UserFactory {
    public static function createFromArray(array $data): User {
        return new User(
            $data['id'],
            $data['name'],
            $data['lastName'],
            $data['email'],
            $data['password'],
            $data['profile_picture'],
            $data['created_at'],
            $data['updated_at']
        );
    }
}