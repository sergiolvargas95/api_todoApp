<?php

namespace Todo\Admin\models;

class Todo {
    private ?int $id;
    private string $title;
    private ?string $description;
    private string $priority;
    private string $status;
    private bool $completed;
    private string $created_at;
    private string $updated_at;
    private ?string $completed_at;
    private int $user_id;
    private ?int $category_id;

    public function __construct(
        ?int $id,
        string $title,
        ?string $description,
        string $priority,
        string $status,
        bool $completed,
        string $created_at,
        string $updated_at,
        ?string $completed_at,
        int $user_id,
        ?int $category_id
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;
        $this->completed = $completed;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->completed_at = $completed_at;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): string {
        return $this->priority;
    }

    public function setPriority(string $priority): self {
        $this->priority = $priority;

        return $this;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): self {
        $this->status = $status;

        return $this;
    }

    public function isCompleted(): bool {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self {
        $this->completed = $completed;

        return $this;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): string {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCompletedAt(): ?string {
        return $this->completed_at;
    }

    public function setCompletedAt(?string $completed_at): self {
        $this->completed_at = $completed_at;

        return $this;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCategoryId(): ?int {
        return $this->category_id;
    }


    public function setCategoryId(?int $category_id): self {
        $this->category_id = $category_id;

        return $this;
    }
}