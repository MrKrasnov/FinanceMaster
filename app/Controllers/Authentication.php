<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\AuthenticationRequest;
use App\Requests\RegistrationRequest;

class Authentication extends Controller
{
    public function actionIndex()
    {
        $this->view->renderPage('Authentication Form', new \App\Models\Authentication());
    }

    public function actionAuthentication(AuthenticationRequest $request)
    {
        $vars = [
        ];

        $this->view->renderPage('Authentication Form', new \App\Models\Authentication());
    }

    public function actionRegistration(RegistrationRequest $request)
    {
        $vars = [
        ];

        $this->view->renderPage('Authentication Form', new \App\Models\Authentication());
    }
}