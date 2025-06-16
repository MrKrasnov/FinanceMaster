<?php

namespace App\Validators;

use App\Exceptions\ValidationException;

class RegistrationValidate extends \App\Core\Validate
{

    /**
     * @throws ValidationException
     */
    public function validate(): bool
    {
        if(!$this->isPOSTrequest()) {
            return false;
        }

        if(!$this->isFormDataContentType()) {
            return false;
        }

        if(!$this->isJsonAcceptType()) {
            return false;
        }

        $requiredFields = ['token', 'login', 'email', 'password', 'repeat-password'];

        if (!$this->isNotEmptyPostFields($requiredFields)) {
            return false;
        }

        if($_POST['password'] !== $_POST['repeat-password']) {
            return false;
        }

        return true;
    }
}