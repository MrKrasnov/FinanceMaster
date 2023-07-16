<?php

namespace App\Controllers;

class Authentication extends \App\Core\Controller
{

    public function doAction()
    {

        $vars = [
        ];

        $this->view->renderPage('Authentication Form', $vars);
    }
}