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
        if (RequestMethod::fromServer() === RequestMethod::Get) {
            return true;
        }

        throw new ValidationException("Invalid request method. GET required.");
    }

    /**
     * @throws ValidationException
     */
    public function isPOSTrequest() : bool
    {
        if (RequestMethod::fromServer() === RequestMethod::Post && !empty($_POST)) {
            return true;
        }

        throw new ValidationException("Invalid request method. POST required.");
    }

    /**
     * @throws ValidationException
     */
    public function isFormDataContentType() : bool
    {
        if (ContentType::fromServer() === ContentType::FormData) {
            return true;
        }

        throw new ValidationException("Invalid Content-Type. Expected 'multipart/form-data'.");
    }

    /**
     * @param array<string> $requiredFields
     * @return bool
     * @throws ValidationException
     */
    function isNotEmptyPostFields(array $requiredFields) : bool
    {
        foreach ($requiredFields as $field) {
            if (!empty(trim($_POST[$field] ?? ''))) {
                throw new ValidationException("Field '$field' is missing or empty.");
            }
        }
        return true;
    }
}