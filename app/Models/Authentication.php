<?php

namespace App\Models;

use App\Core\Model;

class Authentication extends Model
{
    public string $csrfToken;
    public string $csrfTokenExpire;

    public function __construct()
    {
        parent::__construct();

        $this->generateCSRFToken();
        $this->generateCSRFTokenLifeExpire();
    }

    private function generateCSRFToken(): void
    {
        if (!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $this->csrfToken = $_SESSION['csrf_token'];
    }

    private function generateCSRFTokenLifeExpire(): void
    {
        if (!isset($_SESSION['csrf_token_expire'])){
            $_SESSION['csrf_token_expire'] = time() + 3600;
        }

        $this->csrfTokenExpire = $_SESSION['csrf_token_expire'];
    }
}