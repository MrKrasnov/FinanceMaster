<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Requests\DashboardRequest;

class Dashboard extends Controller
{
    public function actionIndex(DashboardRequest $request)
    {
        $result = $this->model->getDashboardIndex($request);

        $this->view->renderPage('Dashboard', $result);
    }
}