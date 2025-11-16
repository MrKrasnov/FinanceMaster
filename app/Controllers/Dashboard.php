<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\DashboardRequest;
use App\Requests\InsertDepositRequest;
use DomainException;
use Exception;

class Dashboard extends Controller
{
    public function actionIndex(DashboardRequest $request)
    {
        try {
            $result = $this->model->getDashboardIndex($request);

            $this->view->renderPage('Dashboard', $result);
        } catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }

    public function actionInsertDeposit(InsertDepositRequest $request) {
        try {
            $idRecord = 1;
            $this->view->renderJsonResponse(201, ['id' => $idRecord]);
        }
        catch (DomainException $exception) {
            $this->view->renderJsonForErrorCode($exception->getCode(), $exception->getMessage());
        } catch (Exception $exception) {
            $this->view->renderJsonForErrorCode(500, $exception->getMessage());
        }
    }
}