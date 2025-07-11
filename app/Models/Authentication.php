<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Dto\User;
use App\Requests\AuthenticationRequest;
use App\Requests\RegistrationRequest;
use App\Services\UserManagement\UserManagement;
use DomainException;

class Authentication extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Provides data required for rendering the registration and login forms on the index page.
     *
     * This method is intended to be called when displaying the main authentication page.
     * It generates and returns CSRF token management data, which should be included in the forms
     * to protect against CSRF attacks. Use the returned CSRF token manager to embed tokens in your
     * registration and login forms for secure submissions.
     *
     * @return array An array containing the CSRF token manager instance, accessible via the 'csrfTokenManager' key.
     */
    public function getFormData() : array
    {
        $csrfTokenManager = new CsrfTokenManager();
        $csrfTokenManager->generateCSRFToken();
        $csrfTokenManager->generateCSRFTokenLifeExpire();

        return ["csrfTokenManager" => $csrfTokenManager];
    }

    public function loginProcess(AuthenticationRequest $request) : bool
    {
        $userManagement = new UserManagement();
        $result = $userManagement->login($request->getUsername(), $request->getPassword());
        if (!isset($result)) {
            throw new DomainException("Failed to login user", 500);
        }

        return $result;
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