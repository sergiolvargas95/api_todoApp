<?php

namespace Todo\Admin\services;

use Exception;
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
        if ($data['password'] !== $data['confirm_password']) {
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
        try {
            $user = $this->authRepository->findUserByEmail($data['email']);

            if(!isset($user)) {
                throw new Exception("The user doesn't exist.");
            }

            if($user && password_verify($data['password'], $user['password_hash'])) {

            }
        } catch (Exception $e) {
            return "Error login user: " . $e->getMessage();
        }
    }
}