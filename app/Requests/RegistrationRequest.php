<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\RegistrationValidate;

class RegistrationRequest extends Request
{
    private string $login;
    private string $email;
    private string $password;

    public function setRequestParams(): void
    {
        extract($_POST);

        $this->setLogin($login)
             ->setEmail($email)
             ->setPassword($password);
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new RegistrationValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): RegistrationRequest
    {
        $this->login = trim($login);
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): RegistrationRequest
    {
        $this->email = trim($email);
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): RegistrationRequest
    {
        $this->password = trim($password);
        return $this;
    }
}