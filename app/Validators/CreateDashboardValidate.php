<?php

namespace App\Validators;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Validate;
use App\Exceptions\ValidationException;

class CreateDashboardValidate extends Validate
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

        $requiredFields = ['owner', 'description', 'title'];

        if (!$this->isNotEmptyPostFields($requiredFields)) {
            return false;
        }

        if(strlen($_POST['title']) > 30) {
            throw new ValidationException("Field title is very long.");
        }

        if(strlen($_POST['description']) > 100) {
            throw new ValidationException("Field description is very long.");
        }

        return true;
    }
}