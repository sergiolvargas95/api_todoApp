<?php

namespace Todo\Admin\core;

use Todo\Admin\config\Database;

class Model {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function query(string $query) {
        return $this->db->connect()->query($query);
    }

    public function prepare(string $query) {
        return $this->db->connect()->prepare($query);
    }
}