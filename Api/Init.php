<?php

namespace Api;

use Frame\Init\Bootstrap;

class Init extends Bootstrap
{
    protected function initRoutes()
    {
        $routes['userGet']     = ['route' => '/user/fetch', 'controller' => 'UserController', 'action' => 'getAll'];
        $routes['userGetById'] = ['route' => '/user/find', 'controller' => 'UserController', 'action' => 'getById'];
        $routes['userPost']    = ['route' => '/user/insert', 'controller' => 'UserController', 'action' => 'post'];
        $routes['userPut']     = ['route' => '/user/update', 'controller' => 'UserController', 'action' => 'put'];

        $this->setRoutes($routes);
    }
}
