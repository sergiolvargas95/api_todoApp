<?php

namespace Todo\Admin\controllers;

class AuthController {
    private $AuthService;

    public function __construct($authService) {
        $this->AuthService = $authService;
    }

    public function register() {
        $data = json_encode(file_get_contents("php://input"));

        if(!$data || isset($data['name'], $data['lastname'], $data['email'], $data['password'])){
            http_response_code(400);
            return json_encode(["error"  => "Invalid data"]);
        }

    }

    public function login() {

    }

    public function logout() {

    }
}