<?php

namespace App\Validators;

use App\Core\Validate;

class IndexValidate extends Validate
{

    public function validate(): bool
    {
        $login = $_SESSION['login'] ?? NULL;

        if (!isset($login)) {
            return false;
        }

        return true;
    }
}