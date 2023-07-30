<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Log;
use App\Core\Validate;
use App\Core\View;

class Authentication extends Controller
{
    public function actionIndex(Validate $validate)
    {
        if(!$validate->validateRequest()) {
            Log::writeLog('Error: 400 Bad Request');
            View::renderErrorCodePage(400);
        }

        $vars = [
        ];

        $this->view->renderPage('Authentication Form', $vars);
    }
}