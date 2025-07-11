<?php

namespace App\Validators;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Validate;
use App\Exceptions\ValidationException;

class AuthenticationValidate extends Validate
{
    /**
     * @throws ValidationException
     */
    public function validate() : bool
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

        $requiredFields = ['username', 'password'];

        if (!$this->isNotEmptyPostFields($requiredFields)) {
            return false;
        }

        return true;
    }
}