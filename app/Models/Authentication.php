<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Dto\User;
use App\Requests\RegistrationRequest;
use App\Services\UserManagement\UserManagement;
use DomainException;

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

    public function registrationProcess(RegistrationRequest $request) : int
    {
        $userManagement = new UserManagement();
        $user = $userManagement->registration($request->getLogin(), $request->getEmail(), $request->getPassword());
        if (!isset($user)) {
            throw new DomainException("Failed to register user", 500);
        }

        return $user->getId();
    }
}