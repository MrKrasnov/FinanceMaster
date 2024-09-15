<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\AuthenticationValidate;

class AuthenticationRequest extends Request
{
    public function setRequestParams(): void
    {
        // TODO: Implement setRequestParams() method.
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new AuthenticationValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }

    }
}