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

    private function generateCSRFToken()
    {
//        Нужно создать генерацию csrf токена, затем он должен записываться в свойство класса app/Models/Authentication.php
//        Далее это свойство нужно записать в глобальный массив $_SESSION['csrf_token']
        if (!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->csrfToken = $_SESSION['csrf_token'];
    }
}