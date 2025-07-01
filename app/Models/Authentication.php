<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;

class Authentication extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getFormData() : array
    {
        $csrfTokenManager = new CsrfTokenManager();
        $csrfTokenManager->generateCSRFToken();
        $csrfTokenManager->generateCSRFTokenLifeExpire();

        return ["csrfTokenManager" => $csrfTokenManager];
    }

    public function registrationProcess() : array
    {
        //TODO: set user in the database.

        return [];
    }
}