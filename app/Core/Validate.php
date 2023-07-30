<?php

namespace App\Core;

use ReflectionClass;

abstract class Validate
{
    abstract public function validate();

    public function isGETrequest() : bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPOSTrequest() : bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);
    }



}