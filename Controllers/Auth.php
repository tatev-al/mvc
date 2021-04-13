<?php

namespace Controllers;
use System\Controller;

class Auth extends Controller 
{
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(empty($_POST["email"]))
            {
                $this->view->emailError = "Email is required";
            }
            if(empty($_POST["password"]))
            {
                $this->view->passwordError = "Password is required";
            }
            if(!empty($_POST['email']) && !empty($_POST['password']))
            {
                var_dump($_POST);
            }
        }
        $this->view->render("register");
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(empty($_POST["email"]))
            {
                $this->view->emailError = "Email is required";
            }
            if(empty($_POST["password"]))
            {
                $this->view->passwordError = "Password is required";
            }
            if(!empty($_POST['email']) && !empty($_POST['password']))
            {
                var_dump($_POST);
            }
        }
        $this->view->render("login");
    }

    public function test()
    {
        var_dump($_POST);
    }

    public function index()
    {
        echo 'index method of \'Auth\' class';
    }
}