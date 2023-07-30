<?php

namespace App\Validators;

class RegistrationValidate extends \App\Core\Validate
{

    public function validate()
    {
        if(!$this->isPOSTrequest()) {
            return false;
        }

        return true;
    }
}