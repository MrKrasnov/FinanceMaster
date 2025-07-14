<?php

namespace App\Models;

use App\Core\Model;
use App\Services\UserManagement\UserManagement;

class Index extends Model
{
    function getFinansesIndex() : array
    {
        $login = $_SESSION['login'] ?? 'user void, ha-ha';

        return ['login' => $login];
    }

    function logout()
    {
        $userManager = new UserManagement();
        $userManager->logout();
    }
}