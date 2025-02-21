<?php

namespace Todo\Admin\models;

class Category {
    private ?int $id;
    private $name;
    private $color;

    public function __construct(?int $id, string $name, string $color) {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
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
}