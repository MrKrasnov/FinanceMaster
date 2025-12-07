<?php

namespace App\Dto\Records;

class CreateRecord
{
    private string $name;
    private int $category_id;
    private float $price;
    private string $by_user;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateRecord
    {
        $this->name = $name;
        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): CreateRecord
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): CreateRecord
    {
        $this->price = $price;
        return $this;
    }

    public function getByUser(): string
    {
        return $this->by_user;
    }

    public function setByUser(string $by_user): CreateRecord
    {
        $this->by_user = $by_user;
        return $this;
    }

    public function getArray() :array
    {
        return [
            'name' => $this->getName(),
            'category_id' => $this->getCategoryId(),
            'price' => $this->getPrice(),
            'by_user' => $this->getByUser(),
        ];
    }
}