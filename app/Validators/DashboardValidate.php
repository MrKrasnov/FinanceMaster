<?php

namespace App\Validators;

use App\Core\Validate;

class DashboardValidate extends Validate
{

    public function validate(): bool
    {
        $login = $_SESSION['login'] ?? NULL;
        $dashboard_id = $_GET['dashboard_id'] ?? null;

        if (!isset($login, $dashboard_id)) {
            return false;
        }

        return true;
    }
}