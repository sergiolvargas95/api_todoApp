<?php

namespace Todo\Admin\repositories;

use PDO;
use Todo\Admin\interfaces\IAuthRepository;
use Todo\Admin\models\User;

class AuthRepository implements IAuthRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function emailExists(string $email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute([":email" => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function register(User $user) {
        $stmt = $this->db->prepare("INSERT INTO users (name, last_name, email, password_hash, profile_picture, created_at, updated_at)
                                    VALUES (:name, :last_name, :email, :password, :profile_picture, :created_at, :updated_at )");
        return $stmt->execute([
            ":name" => $user->getName(),
            ":last_name" => $user->getLastName(),
            ":email" => $user->getEmail(),
            ":password" => $user->getPassword(),
            ":profile_picture" => $user->getProfilePicture(),
            ":created_at" => $user->getCreatedAt(),
            ":updated_at" => $user->getUpdatedAt()
        ]);
    }

    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT id, name, password_hash, email FROM users WHERE email = :email");

        $stmt->execute([
            "email" => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRevokedToken($token) {
        $stmt = $this->db->prepare("INSERT INTO revoked_tokens (token, revoked_at) VALUES (:token, NOW())");

        return $stmt->execute([
            ":token" => $token
        ]);
    }

    public function isTokenRevoked($token):bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM revoked_tokens WHERE token = :token");

        $stmt->execute([
            ":token" => $token
        ]);

        return $stmt->fetchColumn() > 0;
    }
}