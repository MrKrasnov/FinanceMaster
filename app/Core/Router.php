<?php


namespace App\Core;

class Router
{
    protected array $routes = [];

    public function __construct()
    {
        $arr = require './app/config/router-paths.php';

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
        $url = trim($_SERVER['REQUEST_URI'], "/");

        if(!str_contains($url, 'authentication') && !$this->checkAuth()) { // TODO checkCookiesAuth
            self::redirect("/authentication");
        }

        $urlArr = explode('/' , $url);
        $controllerName   = $urlArr[0];
        $controllerMethod = $urlArr[1] ?? 'index';
        $controllerMethod = 'action' . ucfirst($controllerMethod);

        $requestClass = Request::getValidRequest($controllerName , $controllerMethod);

        $controller = $this->getController($controllerName );

        if(isset($requestClass)) {
            $controller->$controllerMethod($requestClass);
        } else {
            $controller->$controllerMethod();
        }

    }

    private function getController(string $mainUrl) : Controller
    {
       if(!array_key_exists($mainUrl, $this->routes)) {
           View::renderErrorCodePage(404);
       }

       $params = $this->routes[$mainUrl];
       $controllerPath = 'App\Controllers\\'.ucfirst($params['controller']);

       if(!class_exists($controllerPath)) {
           View::renderErrorCodePage(404);
       }

       return new $controllerPath($params);
    }

    public static function redirect(string $url) :void
    {
        header('location: '.$url);
        exit;
    }

    public function checkAuth() : bool
    {
        //TODO checkCookiesAuth
        return false;
        return true;
    }
}