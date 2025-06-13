<?php

namespace App\Core\Enum;

use App\Exceptions\ValidationException;

enum AcceptType: string
{
    case Json = 'application/json';
    case Html = 'text/html';
    case Xml  = 'application/xml';
    case PlainText = 'text/plain';
    case Any  = '*/*';

    /**
     * @throws ValidationException
     */
    public static function fromServer(): self
    {
        if (!isset($_SERVER['HTTP_ACCEPT'])) {
            throw new ValidationException("Missing Accept header in request.");
        }

        $acceptHeader = $_SERVER['HTTP_ACCEPT'];

        foreach (self::cases() as $case) {
            if (str_contains($acceptHeader, $case->value)) {
                return $case;
            }
        }

        throw new ValidationException("Unsupported Accept type: " . $acceptHeader);
    }
}
