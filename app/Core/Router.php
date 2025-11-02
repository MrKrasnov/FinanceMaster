<?php


namespace App\Core;

use App\Core\Manager\SessionTokenManager;

class Router
{
    protected array $routes = [];
    private SessionTokenManager $sessionTokenManager;

    public function __construct()
    {
        $arr = require './app/config/router-paths.php';

        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }

        $sessionTokenManager = new SessionTokenManager();
        $this->sessionTokenManager = $sessionTokenManager;
    }

    private function add($route, $params) : void
    {
        $this->routes[$route] = $params;
    }

    public function run($urlParam): void
    {
        $url = trim($urlParam, "/");

        if(!str_contains($url, 'authentication') && !$this->checkAuth()) {
            self::redirect("/authentication");
        } else if(str_contains($url, 'authentication') && $this->checkAuth()) {
            self::redirect("/");
        }

        $urlArr = explode('/' , $url);
        $controllerName   = empty($urlArr[0]) ? 'index' : $urlArr[0];

        if(str_contains($controllerName, "?")) $controllerName = strstr($controllerName, '?', true);

        $controllerMethod = $urlArr[1] ?? 'index';
        $controllerMethod = 'action' . ucfirst($controllerMethod);

        $requestClass = Request::getValidRequest($controllerName, $controllerMethod);

        $controller = $this->getController($controllerName);

        if(isset($requestClass)) { //If there is a request class
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

    private function checkAuth() : bool
    {
        if($this->sessionTokenManager->isAuthenticated()) {
            return true;
        }

        //NOTE: in future we will use cookie for auth
        
        return false;
    }
}