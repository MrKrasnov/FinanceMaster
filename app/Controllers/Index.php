<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\LogoutRequest;
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
}