<?php

namespace App\Requests;

use App\Core\Request;
use App\Exceptions\ValidationException;
use App\Validators\IndexValidate;

class IndexRequest extends Request
{
    private string $login;

    public function setRequestParams(): void
    {
        $this->setLogin($_SESSION['login']);
    }

    /**
     * @throws ValidationException
     */
    public  function doValidate() : void
    {
        $resultValidate = (new IndexValidate())->validate();

        if(!$resultValidate) {
            throw new ValidationException('Validation failed');
        }
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): IndexRequest
    {
        $this->login = trim($login);
        return $this;
    }
}