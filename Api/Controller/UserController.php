<?php

namespace Api\Controller;

use Api\Entity\User;
use Api\Repository\UserRepository;

class UserController
{
    private $user;
    private $repository;

    public function __construct()
    {
        $this->user = new User();
        $this->repository = new UserRepository('user');
    }

    public function getAll()
    {
        echo json_encode($this->repository->fetch());
    }

    public function post()
    {
        if (isset($_POST) and !empty($_POST)) {

            $this->user->setName($_POST['name']);
            $this->user->setEmail($_POST['email']);
            $this->user->setLogin($_POST['login']);
            $this->user->setPassword($_POST['password']);


            $result = $this->repository->insert($this->user->toArray());

            echo json_encode($result);
        }

        echo json_encode(['result' => 'falid']);
    }

    public function put()
    {
        if (isset($_POST) and !empty($_POST)) {

            $this->user->setName($_POST['name']);
            $this->user->setEmail($_POST['email']);
            $this->user->setLogin($_POST['login']);
            $this->user->setPassword($_POST['password']);


            $result = $this->repository->insert($this->user->toArray());

            return json_encode($result);
        }

        return json_encode(['result' => 'falid']);
    }

    public function delete()
    {
        $result = $this->repository->delete($_GET['id']);

        return json_encode($result);
    }

}
