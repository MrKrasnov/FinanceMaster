<?php

namespace App\Validators;

use App\Core\Validate;

class AuthenticationValidate extends Validate
{
    public function validate() : bool
    {
        if(!$this->isPOSTrequest()) {
            return false;
        }

        return true;
    }
}