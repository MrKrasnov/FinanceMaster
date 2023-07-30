<?php

namespace App\Core;

use ReflectionClass;

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

        if($url !== "authentication" && !$this->checkAuth()) { // TODO checkCookiesAuth
            self::redirect("/authentication");
        }

        $urlArr = explode('/' , $url);
        $mainUrl= $urlArr[0];
        $method = $urlArr[1] ?? 'index';
        $method = 'action' . ucfirst($method);

        $controller = $this->getController($mainUrl);

        try{
            $validateClass = new ReflectionClass( "App\Validators\\".ucfirst($mainUrl).'Validate');
        }  catch (\ReflectionException $e) {
            Log::writeLog('Don\'t found a validator class with the help the ReflectionClass');
            $controller->$method();
        }

        $controller->$method($validateClass->newInstance());
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