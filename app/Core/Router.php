<?php

namespace App\Core;

class Router
{
    protected array $routes = [];
    protected array $routeArguments = [];

    public function __construct()
    {
        $arr = require '../config/router-paths.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    private function add($route, $params) : void
    {
        $this->routes[$route] = $params;
    }

    public function match() : bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $routePath => $routeArguments) {
            if ($routePath === $url) {
                $this->routeArguments = $routeArguments;
                return true;
            }
        }
        return false;
    }

    public function run(): void
    {
        if(!$this->match()) {
            View::renderErrorCodePage(404);
        }else{
            //TODO maybe, i should use try.. catch in this block code

            echo 'О такой путь есть!';
        }

    }

}