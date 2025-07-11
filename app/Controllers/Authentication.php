<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Requests\AuthenticationRequest;
use App\Requests\RegistrationRequest;
use DomainException;
use Exception;

class Authentication extends Controller
{
    public function actionIndex()
    {
        $model = new \App\Models\Authentication();
        $this->view->renderPage('Authentication Form', $model->getFormData());
    }

    public function actionAuthentication(AuthenticationRequest $request)
    {
        $model = new \App\Models\Authentication();
        $model->loginProcess($request);

        $vars = [
        ];

        $this->view->renderPage('Authentication Form', []);
    }

    public function actionRegistration(RegistrationRequest $request)
    {
        $model = new \App\Models\Authentication();
        try {
            $idUser = $model->registrationProcess($request);
            $this->view->renderJsonResponse(201, ['id' => $idUser]);
        }
        catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }
}