<?php

namespace App\Core;

abstract class Controller
{
    public Model $model;
    public View  $view;

    public function __construct(array $route) {
        $this->view  = new View($route['view']);
        $this->model = $this->loadModel($route['controller']);
    }

    abstract public function doAction();

    public function loadModel($name) : Model
    {
        $path = 'App\Models\\'.ucfirst($name);
        return new $path;
    }
}