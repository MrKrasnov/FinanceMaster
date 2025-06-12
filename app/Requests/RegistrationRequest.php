<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\AuthenticationValidate;
use App\Core\ContentType;

class RegistrationRequest extends Request
{
    private string $login;
    private string $email;
    private string $password;
    private string $repeatPassword;

    /**
     * @throws ValidationException
     */
    public function setRequestParams(ContentType $contentType): void
    {
        if($contentType === ContentType::FormData) {
            $this->setCsrfToken($_POST["token"])
                 ->setLogin($_POST["login"])
                 ->setEmail($_POST["email"])
                 ->setPassword($_POST["password"])
                 ->setRepeatPassword($_POST["repeat-password"]);
            return;
        }

        throw new ValidationException("Unsupported Content-Type " . $contentType->value . " for Registration form");
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

    private string $csrfToken;

    public function getCsrfToken(): string
    {
        return $this->csrfToken;
    }

    public function setCsrfToken(string $csrfToken): RegistrationRequest
    {
        $this->csrfToken = trim($csrfToken);
        return $this;
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

    public function getRepeatPassword(): string
    {
        return $this->repeatPassword;
    }

    public function setRepeatPassword(string $repeatPassword): RegistrationRequest
    {
        $this->repeatPassword = trim($repeatPassword);
        return $this;
    }
}