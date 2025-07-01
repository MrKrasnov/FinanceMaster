<?php

namespace App\Validators;

use App\Core\Manager\CsrfTokenManager;
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

        if(!CsrfTokenManager::validateCSRFToken()) {
            return false;
        }

        $requiredFields = ['login', 'email', 'password', 'repeat-password'];

        if (!$this->isNotEmptyPostFields($requiredFields)) {
            return false;
        }

        if($_POST['password'] !== $_POST['repeat-password']) {
            return false;
        }

        return true;
    }
}