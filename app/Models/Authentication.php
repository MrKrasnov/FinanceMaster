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
        $this->csrfToken = $_SESSION['csrf_token'];
    }
}