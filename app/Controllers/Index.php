<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\CreateDashboardRequest;
use App\Requests\LogoutRequest;
use DomainException;
use Exception;

class Index extends Controller
{
    public function actionIndex()
    {
        $result = $this->model->getFinansesIndex();

        $this->view->renderPage('Home page', $result);
    }

    function actionLogout(LogoutRequest $request)
    {
        try{
            $this->model->logout();
            $this->view->renderJsonResponse(200, ["success" => "ok"]);
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }

    function actionCreateDashboard(CreateDashboardRequest $request)
    {
        try {
            $idDashboard = $this->model->createDashboard($request);
            $this->view->renderJsonResponse(201, ['id' => $idDashboard]);
        }
        catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }
}