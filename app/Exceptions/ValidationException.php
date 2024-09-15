<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\Pure;

class ValidationException extends \Exception
{
    #[Pure] public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }

}