<?php

namespace Todo\Admin\middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDO;
use Todo\Admin\exceptions\UnauthorizedException;

class AuthMiddleware {
    private static array $publicRoutes = [
        '/login',
        '/register'
    ];

    public static function handle($authRepository) {
        $requestUri = $_SERVER['REQUEST_URI'];

        if (in_array($requestUri, self::$publicRoutes)) {
            return;
        }

        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            throw new UnauthorizedException("Missing authorization token.");
        }

        $authHeader = $headers['Authorization'];
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            throw new UnauthorizedException("Invalid authorization format.");
        }

        $token = $matches[1];

        if ($authRepository->isTokenRevoked($token)) {
            http_response_code(401);
            echo json_encode(["error" => "Token revoked"]);
        }

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], 'HS256'));

            $_SERVER['AUTH_USER_ID'] = $decoded->user_id;

        } catch (\Exception $e) {
            throw new UnauthorizedException("Invalid or expired token.");
        }
    }
}
