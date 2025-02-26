<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\User;

interface IAuthRepository {
    public function emailExists(string $email);
    public function register(User $user);
    public function findUserByEmail(User $user);
}