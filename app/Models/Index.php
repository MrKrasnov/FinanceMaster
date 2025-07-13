<?php

namespace App\Models;

use App\Core\Model;

class Index extends Model
{
    function getFinansesIndex() : array
    {
        $login = $_SESSION['login'] ?? 'user void, ha-ha';

        return ['login' => $login];
    }
}