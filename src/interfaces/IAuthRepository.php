<?php

namespace Todo\Admin\interfaces;

use Todo\Admin\models\User;

interface IAuthRepository {
    public function login();
    public function register(User $user);
    public function logout();
}