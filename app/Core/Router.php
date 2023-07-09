<?php

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function __construct()
    {
        $arr = require '../app/config/router-paths.php';

        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    private function add($route, $params) : void
    {
        $this->routes[$route] = $params;
    }

    public function run(): void
    {
        //TODO maybe, i should use try.. catch in this block code
        $controller = $this->getController();
        $controller->doAction();
    }

    private function getController() : Controller
    {
       $url = trim($_SERVER['REQUEST_URI'], "/");

       if(!array_key_exists($url, $this->routes)) {
           View::renderErrorCodePage(404);
       }

       $params = $this->routes[$url];
       $controllerPath = 'App\Controllers\\'.ucfirst($params['controller']);

       if(!class_exists($controllerPath)) {
           View::renderErrorCodePage(404);
       }

       return new $controllerPath($params);
    }

    public static function redirect(string $url) :void
    {
        //TODO need redirect
    }

}