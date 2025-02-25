<?php

namespace Todo\Admin\services;

use Exception;
use Todo\Admin\factories\UserFactory;
use Todo\Admin\repositories\AuthRepository;

class AuthService {
    private $authRepository;

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }

    public function registerUser(array $data) {
        try {
            if ($data['password'] !== $data['confirm_password']) {
                throw new Exception("Passwords must be identical");
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }

            if (strlen($data['password']) < 8) {
                throw new Exception("Password must be at least 8 characters long");
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $user = UserFactory::createFromArray($data);
            return $this->authRepository->register($user);
        } catch (Exception $e) {
            return "Error registering user: " . $e->getMessage();
        }
    }
}