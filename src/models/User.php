<?php

namespace Todo\Admin\models;

class User {
    private ?int $id;
    private string $name;
    private string $lastName;
    private string $email;
    private string $password;
    private ?string $profilePicture;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        ?int $id,
        string $name,
        string $last_name,
        string $email,
        string $password,
        ?string $profilePicture,
        string $created_at,
        string $updated_at
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;

        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    public function getProfilePicture(): ?string {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self {
        $this->profilePicture = $profilePicture;

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
}