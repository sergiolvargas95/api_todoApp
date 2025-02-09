<?php

namespace Todo\Admin\config;

use PDO;
use PDOException;

class Database {
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    private string $charset;

    public function __construct() {
        $this->host = $_ENV['HOST'];
        $this->dbname = $_ENV['DBNAME'];
        $this->username = $_ENV['USERNAME'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset = $_ENV['CHARSET'];
    }

    public function connect(): PDO{
        try {
            $dsn = "mysql:host=" .  $this->host . ";dbname= " . $this->dbname . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $pdo = new PDO($dsn, $this->username, $this->password, $options);

            return $pdo;
        } catch(PDOException $e) {
            throw $e;
        }
    }

}