<?php

namespace App\Core\Manager;

use DomainException;

class SessionTokenManager
{
    private const SESSION_LIFETIME = 7200; // 2 hours in seconds

    public function login(int $id, $user): bool
    {      
        if ($this->isAuthenticated()) {
            $this->logout();
            throw new DomainException("User already logged in. Login again.", 400);
        }
        
        // secure session from session fixation
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $id;
        $_SESSION['login'] = $user;
        $_SESSION['is_authenticated'] = true;
        $_SESSION['login_time'] = time();
        $_SESSION['user_agent'] = USER_AGENT;
        return true;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

    public function isAuthenticated(): bool
    {
        if (!(isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated'] === true)) {
            return false;
        }

        if ($_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {
            $this->logout();
            return false;
        }

        if (time() - $_SESSION['login_time'] > self::SESSION_LIFETIME) { 
            $this->logout();
            return false;
        }

        return true;
    }
}