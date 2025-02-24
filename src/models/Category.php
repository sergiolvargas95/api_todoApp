<?php

namespace Todo\Admin\models;

class Category {
    private ?int $id;
    private $name;
    private $color;
    private $user_id;

    public function __construct(?int $id, string $name, string $color, int $user_id) {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->user_id = $user_id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): self {
        $this->name = $name;
        return $this;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color): self {
        $this->color = $color;
        return $this;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id): self {
        $this->user_id = $user_id;

        return $this;
    }
}