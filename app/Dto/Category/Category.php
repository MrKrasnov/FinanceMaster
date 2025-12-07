<?php

namespace App\Dto\Category;

class Category
{
    private string $id;
    private string $name;
    private string $logo_url;
    private string $board_id;
    private int $type_record;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Category
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    public function getLogoUrl(): string
    {
        return $this->logo_url;
    }

    public function setLogoUrl(string $logo_url): Category
    {
        $this->logo_url = $logo_url;
        return $this;
    }

    public function getBoardId(): string
    {
        return $this->board_id;
    }

    public function setBoardId(string $board_id): Category
    {
        $this->board_id = $board_id;
        return $this;
    }

    public function getTypeRecord(): int
    {
        return $this->type_record;
    }

    public function setTypeRecord(int $type_record): Category
    {
        $this->type_record = $type_record;
        return $this;
    }


}