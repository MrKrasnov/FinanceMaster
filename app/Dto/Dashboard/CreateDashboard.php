<?php

namespace App\Dto\Dashboard;

use App\Dto\User;

class CreateDashboard
{
    private User $owner;
    private string $title;
    private string $description;
    private int $denomination;

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): CreateDashboard
    {
        $this->owner = $owner;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): CreateDashboard
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CreateDashboard
    {
        $this->description = $description;
        return $this;
    }

    public function getDenomination(): int
    {
        return $this->denomination;
    }

    public function setDenomination(int $denomination): CreateDashboard
    {
        $this->denomination = $denomination;
        return $this;
    }


}