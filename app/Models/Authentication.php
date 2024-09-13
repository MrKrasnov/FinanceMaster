<?php

namespace App\Models;

use App\Core\Model;

class Authentication extends Model
{
    public string $csrfToken;

    public function __construct()
    {
        parent::__construct();

        $this->generateCSRFToken();
    }

    private function generateCSRFToken()
    {
        if (!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->csrfToken = $_SESSION['csrf_token'];
    }
}