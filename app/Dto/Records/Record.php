<?php

namespace App\Dto\Records;

class Record
{
    private int $id;
    private string $name;
    private int $category_id;
    private float $price;
    private string $created_at;
    private string $by_user;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Record
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Record
    {
        $this->name = $name;
        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): Record
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Record
    {
        $this->price = $price;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): Record
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getByUser(): string
    {
        return $this->by_user;
    }

    public function setByUser(string $by_user): Record
    {
        $this->by_user = $by_user;
        return $this;
    }
}