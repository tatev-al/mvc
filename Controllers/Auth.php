<?php

namespace Controllers;
use System\Controller;

class Auth extends Controller 
{
    public function register()
    {
        $this->view->render("register");
    }

    public function login()
    {
        $this->view->render("login");
    }

    public function welcome()
    {
        $this->view->render("welcome");
    }

    public function index()
    {
        echo 'index method of \'Auth\' class';
    }
}