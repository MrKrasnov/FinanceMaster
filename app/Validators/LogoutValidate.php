<?php

namespace App\Validators;

use App\Core\Validate;
use App\Exceptions\ValidationException;

class LogoutValidate extends Validate
{

    /**
     * @throws ValidationException
     */
    public function validate(): bool
    {
        if(!$this->isJsonAcceptType()) {
            return false;
        }

        return true;
    }
}