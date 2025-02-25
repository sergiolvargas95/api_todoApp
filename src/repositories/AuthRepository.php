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

    public function login() {

    }

    public function register(User $user) {
        $stmt = $this->db->prepare("INSERT INTO users (name, last_name, email, password, profile_picture, created_at, updated_at)
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

    public function logout(){
        
    }
}