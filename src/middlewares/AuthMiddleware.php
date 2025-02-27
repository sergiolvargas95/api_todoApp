<?php

namespace Todo\Admin\middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Todo\Admin\exceptions\UnauthorizedException;

class AuthMiddleware {
    private static array $publicRoutes = [
        '/login',
        '/register'
    ];

    public static function handle() {
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

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], 'HS256'));

            $_SESSION['user'] = (array) $decoded;

        } catch (\Exception $e) {
            throw new UnauthorizedException("Invalid or expired token.");
        }
    }
}
