<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\LogoutValidate;

class LogoutRequest extends Request
{

    public function setRequestParams(): void
    {

    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new LogoutValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }
}