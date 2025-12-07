<?php

namespace App\Dto\Dashboard;

use App\Dto\User;

class Dashboard
{
    private string $id;
    private string $title;
    private string $description;
    private string $created_at;
    private string $updated_at;
    private ?string $deleted_at;
    private User $owner;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Dashboard
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Dashboard
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Dashboard
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): Dashboard
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): Dashboard
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?string $deleted_at): Dashboard
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): Dashboard
    {
        $this->owner = $owner;
        return $this;
    }
}