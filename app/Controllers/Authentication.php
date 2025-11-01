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
        try {
            $model->loginProcess($request);
            $this->view->renderJsonResponse(200, ['success' => true]);
        }catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }

    public function actionRegistration(RegistrationRequest $request)
    {
        try {
            $idUser = $this->model->registrationProcess($request);
            $this->view->renderJsonResponse(201, ['id' => $idUser]);
        }
        catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }
}