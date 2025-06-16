<?php

namespace App\Core;

use App\Core\Enum\AcceptType;
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
     * @throws ValidationException
     */
    public function isJsonAcceptType() : bool
    {
        if (AcceptType::fromServer() === AcceptType::Json) {
            return true;
        }

        throw new ValidationException("Invalid Accept-Type. Expected 'application/json'.");
    }

    /**
     * @param array<string> $requiredFields
     * @return bool
     * @throws ValidationException
     */
    public function isNotEmptyPostFields(array $requiredFields) : bool
    {
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field] ?? ''))) { 
                throw new ValidationException("Field '$field' is missing or empty.");
            }
        }
        return true;
    }

    /**
     * @throws ValidationException
     */
    public function validateCSRFToken(): bool
    {
        //Parameter names are used in a specialized service, so they must not differ
        if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) || empty($_SESSION['csrf_token_expire'])
        ) {
            throw new ValidationException("Missing CSRF token or expiration parameters");
        }

        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            throw new ValidationException("Invalid CSRF token");
        }

        if (time() > $_SESSION['csrf_token_expire']) {
            throw new ValidationException("Expired CSRF token");
        }

        return true;
    }
}