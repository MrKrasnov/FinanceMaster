<?php

namespace App\Controllers;

use App\Core\Controller;

class Index extends Controller
{
    public function actionIndex()
    {
        $result = $this->model->getFinansesIndex();

        $this->view->renderPage('Home page', $result);
    }
}