<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\AuthenticationValidate;

class AuthenticationRequest extends Request
{
    private string $username;
    private string $password;

    public function setRequestParams(): void
    {
        extract($_POST);

        $this->setUsername($username)
             ->setPassword($password);
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): AuthenticationRequest
    {
        $this->username = trim($username);
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): AuthenticationRequest
    {
        $this->password = trim($password);
        return $this;
    }
}