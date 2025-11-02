<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\DashboardValidate;

class DashboardRequest extends Request
{
    private string $login;
    private int $dashboardId;

    public function setRequestParams(): void
    {
        $this->setLogin($_SESSION['login'])
             ->setDashboardId($_GET['dashboard_id']);
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new DashboardValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): DashboardRequest
    {
        $this->login = trim($login);
        return $this;
    }

    public function getDashboardId(): int
    {
        return $this->dashboardId;
    }

    public function setDashboardId(Int $dashboard_id): DashboardRequest
    {
        $this->dashboardId = $dashboard_id;
        return $this;
    }
}