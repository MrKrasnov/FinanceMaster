<?php

namespace App\Core;

abstract class Validate
{
    public function isGETrequest() : bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPOSTrequest() : bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST);
    }

}