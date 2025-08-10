<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\CreateDashboardValidate;

class CreateDashboardRequest extends Request
{
    private string $username;
    private string $nameDashboard;
    private string $descriptionDashboard;

    public function setRequestParams(): void
    {
        extract($_POST);

        $this->setUsername($owner)
            ->setNameDashboard($title)
            ->setDescriptionDashboard($description);
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new CreateDashboardValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): CreateDashboardRequest
    {
        $this->username = $username;
        return $this;
    }

    public function getNameDashboard(): string
    {
        return $this->nameDashboard;
    }

    public function setNameDashboard(string $nameDashboard): CreateDashboardRequest
    {
        $this->nameDashboard = $nameDashboard;
        return $this;
    }

    public function getDescriptionDashboard(): string
    {
        return $this->descriptionDashboard;
    }

    public function setDescriptionDashboard(string $descriptionDashboard): CreateDashboardRequest
    {
        $this->descriptionDashboard = $descriptionDashboard;
        return $this;
    }
}