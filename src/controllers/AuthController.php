<?php

namespace Todo\Admin\controllers;

use Exception;
use Todo\Admin\services\AuthService;
use Todo\Admin\exceptions\ValidationException;

class AuthController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }


    /**
     * register
     *
     * @return string
     */
    public function register():string {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data || !isset($data['name'], $data['lastName'], $data['email'], $data['password'])){
            http_response_code(400);
            
        }

        try {
            $this->authService->registerUser($data);

            http_response_code(201);
            return json_encode([
                "error" => false,
                "message" => "User created Succesfully"
            ]);
        } catch (ValidationException $e) {
            http_response_code(500);
            return json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data || !isset($data['email'], $data['password'])) {
            return json_encode([
                "error" => true,
                "message" => "Invalid data"
            ]);
        }

        try {
            $result = $this->authService->loginUser($data);

            http_response_code(200);

            return json_encode([
                "error" => false,
                "message" => "Login Successful",
                "token" => $result["token"],
                "user" => $result["user"]
            ]);
        } catch (ValidationException $e) {
            http_response_code(500);
            return json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "An unexpected error occurred."]);
        }
    }

    public function logout() {

    }
}