<?php

namespace App\Core;

use App\Core\Enum\ContentType;
use App\Core\Enum\RequestMethod;
use App\Exceptions\ValidationException;

abstract class Validate
{
    abstract public function validate() : bool;

    /**
     * @throws ValidationException
     */
    public function isGETrequest() : bool
    {
        return RequestMethod::fromServer() === RequestMethod::Get;
    }

    /**
     * @throws ValidationException
     */
    public function isPOSTrequest() : bool
    {
        return RequestMethod::fromServer() === RequestMethod::Post && !empty($_POST);
    }

    /**
     * @throws ValidationException
     */
    public function isFormDataContentType() : bool
    {
        return ContentType::fromServer() === ContentType::FormData;
    }

    /**
     * @param array<string> $requiredFields
     * @return bool
     */
    function isNotEmptyPostFields(array $requiredFields) : bool
    {
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field] ?? ''))) {
                return false;
            }
        }
        return true;
    }
}