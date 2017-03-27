<?php

namespace Frame\Init;

abstract class Bootstrap
{
    private $routes;

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    protected function run($url)
    {
        array_walk($this->routes, function($routes) use ($url){

            if ($url == $routes['route']) {
                $class      = 'Api\\Controller\\' . ucfirst($routes['controller']);
                $controller = new $class;
                $action     = $routes['action'];
                $controller->$action();
            }
        });
    }

    protected function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    protected function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
