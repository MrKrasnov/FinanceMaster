<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Requests\RegistrationRequest;
use App\Services\UserManagement\UserManagement;

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

    public function registrationProcess(RegistrationRequest $request) : array
    {
        $userManagement = new UserManagement();
        $userManagement->registration($request->getLogin(), $request->getEmail(), $request->getPassword());
        return [];
    }
}