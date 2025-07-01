<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\AuthenticationRequest;
use App\Requests\RegistrationRequest;

class Authentication extends Controller
{
    public function actionIndex()
    {
        $model = new \App\Models\Authentication();
        $this->view->renderPage('Authentication Form', $model->getFormData());
    }

    public function actionAuthentication(AuthenticationRequest $request)
    {
        $vars = [
        ];

        $this->view->renderPage('Authentication Form', []);
    }

    public function actionRegistration(RegistrationRequest $request)
    {
        $model = new \App\Models\Authentication();
        $data   = $model->registrationProcess();

        $this->view->renderJsonResponse($data);
    }
}