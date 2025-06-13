<?php

namespace App\Core\Enum;

use App\Exceptions\ValidationException;

enum RequestMethod: string
{
    case Get     = 'GET';
    case Post    = 'POST';
    case Put     = 'PUT';
    case Delete  = 'DELETE';
    case Patch   = 'PATCH';
    case Options = 'OPTIONS';
    case Head    = 'HEAD';

    /**
     * @throws ValidationException
     */
    public static function fromServer(): self
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            throw new ValidationException("Missing REQUEST_METHOD in server variables.");
        }

        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        foreach (self::cases() as $case) {
            if ($case->value === $method) {
                return $case;
            }
        }

        throw new ValidationException("Unsupported HTTP method: " . $method);
    }
}
