<?php

namespace Todo\Admin\services;

use Firebase\JWT\JWT;
use Todo\Admin\exceptions\ValidationException;
use Todo\Admin\factories\UserFactory;
use Todo\Admin\repositories\AuthRepository;

class AuthService {
    private $authRepository;

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }

    /**
     * registerUser
     *
     * @param  mixed $data
     * @return void
     */
    public function registerUser(array $data) {
        $this->validateUserData($data);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = UserFactory::createFromArray($data);
        return $this->authRepository->register($user);
    }

    /**
     * validateUserData
     *
     * @param  mixed $data
     * @return void
     */
    private function validateUserData(array $data) {
        if ($data['password'] !== $data['confirmPassword']) {
            throw new ValidationException("Passwords must be identical");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Invalid email format");
        }

        if (strlen($data['password']) < 8) {
            throw new ValidationException("Password must be at least 8 characters long");
        }

        if ($this->authRepository->emailExists($data['email'])) {
            throw new ValidationException("Email already registered");
        }
    }


    /**
     * loginUser
     *
     * @param  mixed $data
     * @return void
     */
    public function loginUser(array $data) {
            $user = $this->authRepository->findUserByEmail($data['email']);

            if(!isset($user)) {
                throw new ValidationException("User doesn't exist.");
            }

            if(!password_verify($data['password'], $user['password_hash'])) {
                throw new ValidationException("Invalid credentials.");
            }

            return [
                "token" => $this->generateToken($user),
                "user" => [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email']
                ],
            ];
    }

    public function generateToken($user) {
        $key = $_ENV['JWT_SECRET_KEY'];

        $payload = [
            "user_id" => $user['id'],
            "email" => $user['email'],
            "exp" => time() + 3600
        ];

        return JWT::encode($payload, $key, "HS256");
    }

    public function revokeToken(string $token):bool {
        if (!$token) {
            return false;
        }
        return $this->authRepository->createRevokedToken($token);
    }

    public function isTokenRevoked($token) {
        return $this->authRepository->isTokenRevoked($token);
    }
}