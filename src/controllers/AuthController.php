<?php

namespace Todo\Admin\controllers;

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

        $success = $this->authService->registerUser($data);
        var_dump($success);die;
        if ($success) {
            http_response_code(201);
            return json_encode(["message" => "User created Succesfully"]);
        } else {
            http_response_code(500);
            return json_encode(["error" => "Error creating User"]);
        }


    }

    public function login() {

    }

    public function logout() {

    }
}