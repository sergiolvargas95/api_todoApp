<?php

namespace Todo\Admin\controllers;

use Todo\Admin\exceptions\ValidationException;
use Todo\Admin\services\AuthService;

class AuthController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data || !isset($data['name'], $data['lastName'], $data['email'], $data['password'])){
            http_response_code(400);
            return json_encode(["error"  => "Invalid data"]);
        }

        try {
            $this->authService->registerUser($data);

            http_response_code(201);
            return json_encode(["message" => "User created Succesfully"]);
        } catch (ValidationException $e) {
            http_response_code(500);
            return json_encode(["error" => $e->getMessage()]);
        }

    }

    public function login() {

    }

    public function logout() {

    }
}