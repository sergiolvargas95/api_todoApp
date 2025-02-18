<?php

namespace Todo\Admin\config;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $_ENV['HOST'] . ";dbname=" . $_ENV['DBNAME'] . ";charset=" . $_ENV['CHARSET'];
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $this->connection = new PDO($dsn, $_ENV['DBUSER'], $_ENV['PASSWORD'], $options);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    //applying singleton
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}