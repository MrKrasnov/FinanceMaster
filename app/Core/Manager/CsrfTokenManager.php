<?php

namespace App\Core\Manager;

use App\Exceptions\ValidationException;

class CsrfTokenManager
{
    public string $csrfToken;
    public string $csrfTokenExpire;
    public string $csrfTokenNameKey = "csrf_token";


    public function generateCSRFToken(): void
    {
        if (!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $this->csrfToken = $_SESSION['csrf_token'];
    }

    public function generateCSRFTokenLifeExpire(): void
    {
        if (!isset($_SESSION['csrf_token_expire'])){
            $_SESSION['csrf_token_expire'] = time() + 3600;
        }

        $this->csrfTokenExpire = $_SESSION['csrf_token_expire'];
    }

    /**
     * @throws ValidationException
     */
    public static function validateCSRFToken(): bool
    {
        //Parameter names are used in a specialized service, so they must not differ
        if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) || empty($_SESSION['csrf_token_expire'])
        ) {
            self::destroy_session();
            throw new ValidationException("Missing CSRF token or expiration parameters");
        }

        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            self::destroy_session();
            throw new ValidationException("Invalid CSRF token");
        }

        if (time() > $_SESSION['csrf_token_expire']) {
            self::destroy_session();
            throw new ValidationException("Expired CSRF token");
        }

        return true;
    }

    private static function destroy_session() : void
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
}