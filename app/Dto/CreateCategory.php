<?php

namespace App\Dto;

class CreateCategory
{
    private int $dashboard_id;
    private string $name;
    private string $logo_url;
    private int $type_record;

    public function getDashboardId(): int
    {
        return $this->dashboard_id;
    }

    public function setDashboardId(int $dashboard_id): CreateCategory
    {
        $this->dashboard_id = $dashboard_id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCategory
    {
        $this->name = $name;
        return $this;
    }

    public function getLogoUrl(): string
    {
        return $this->logo_url;
    }

    public function setLogoUrl(string $logo_url): CreateCategory
    {
        $this->logo_url = $logo_url;
        return $this;
    }

    public function getTypeRecord(): int
    {
        return $this->type_record;
    }

    public function setTypeRecord(int $type_record): CreateCategory
    {
        $this->type_record = $type_record;
        return $this;
    }
}