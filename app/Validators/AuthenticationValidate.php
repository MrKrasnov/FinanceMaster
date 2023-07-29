<?php

namespace App\Validators;

use App\Core\Validate;

class AuthenticationValidate extends Validate
{
    public function validateRequest() : bool
    {
        if($this->isGETrequest()) {
            return true;
        }

        if(!$this->isPOSTrequest()) {
            return false;
        }

        $requestProcess = $_POST['action'] ?? null;

        if(!isset($requestProcess)) {
            return false;
        }

        if($requestProcess === "Registration") {
            return $this->validateRegistrationRequest();
        }

        if($requestProcess === "Authentication") {
            return $this->validateAuthenticationRequest();
        }

        return false;
    }

    public function validateRegistrationRequest() : bool
    {
        //TODO check params
        return true;
    }

    public function validateAuthenticationRequest() : bool
    {
        //TODO check params
        return true;
    }
}