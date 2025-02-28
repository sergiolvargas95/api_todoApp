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
            return json_encode([
                "error" => true,
                "message" => "Invalid data"
            ]);
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
            http_response_code(500);
            return json_encode([
                "error" => true,
                "message" => "Invalid data"
            ]);
        }

        try {
            $result = $this->authService->loginUser($data);

            header("Authorization: Bearer " . $result['token']);
            http_response_code(200);
            return json_encode([
                "error" => false,
                "message" => "Login Successful",
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
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(400);
            return json_encode(["error" => "Token missing"]);
        }

        $token = $matches[1];
        try {

            $this->authService->revokeToken($token);

            http_response_code(200);
            return json_encode(["message" => "Logged out successfully"]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["Error revoking token: " . $e->getMessage()]);
        }
    }
}