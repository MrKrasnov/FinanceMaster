<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validate;

class Index extends Controller
{
    public function actionIndex()
    {
        $result = $this->model->getFinansesIndex();

        $vars = [
            'news' => $result,
        ];

        $this->view->renderPage('Главная страница', $vars);
    }
}