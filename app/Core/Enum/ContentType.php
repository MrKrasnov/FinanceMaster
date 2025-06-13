<?php

namespace App\Core\Enum;

use App\Exceptions\ValidationException;

enum ContentType : string
{
    case Json = 'application/json';
    case FormData = 'multipart/form-data';
    case UrlEncoded = 'application/x-www-form-urlencoded';

    /**
     * @throws ValidationException
     */
    public static function fromServer(): self
    {
        if (!isset($_SERVER['CONTENT_TYPE'])) {
            throw new ValidationException("Missing Content-Type header in request.");
        }

        $rawType = $_SERVER['CONTENT_TYPE'];

        if (str_starts_with($rawType, self::Json->value)) {
            return self::Json;
        }

        if (str_starts_with($rawType, self::FormData->value)) {
            return self::FormData;
        }

        if (str_starts_with($rawType, self::UrlEncoded->value)) {
            return self::UrlEncoded;
        }

        throw new ValidationException("Unsupported Content-Type: " . $rawType);
    }
}
