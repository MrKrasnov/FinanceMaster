<?php

namespace App\Models;

use App\Core\Model;

class Authentication extends Model
{
    public string $csrfToken;

    public function __construct()
    {
        parent::__construct();
        //$this->generateCSRFToken(); //TODO need create
        //$this->csrfToken = $_SESSION['csrf_token'];
    }

    private function generateCSRFToken()
    {
        //TODO need create
    }
}