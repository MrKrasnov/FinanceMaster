<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\AuthenticationRequest;
use App\Requests\RegistrationRequest;

class Authentication extends Controller
{
    public function actionIndex()
    {
        $vars = [
        ];

        $this->view->renderPage('Authentication Form', $vars);
    }

    public function actionAuthentication(AuthenticationRequest $request)
    {
//        if(!$validate->validateAuthenticationRequest()) {
//            Log::writeLog('Error: 400 Bad Request');
//            View::renderErrorCodePage(400);
//        }

        $vars = [
        ];

        $this->view->renderPage('Authentication Form', $vars);
    }

    public function actionRegistration(RegistrationRequest $request)
    {
//        if(!$validate->validateRegistrationRequest()) {
//            Log::writeLog('Error: 400 Bad Request');
//            View::renderErrorCodePage(400);
//        }

        $vars = [
        ];

        $this->view->renderPage('Authentication Form', $vars);
    }
}