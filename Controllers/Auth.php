<?php

namespace Controllers;

use System\Controller;
use Models\User;

class Auth extends Controller 
{
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(empty($_POST["name"]))
            {
                $this->view->nameError = "Name is required";
            }
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
                $user = new User;
                if($user->userExists($_POST["email"]))
                {
                    $this->view->emailError = "Try another email";
                }
                else if($user->create($_POST))
                {
                    header("Location: login");
                }
                else
                {
                    $this->view->regError = "Invalid registration";
                }
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
                $user = new User;
                $result = $user->login($_POST['email'], $_POST['password']);
                if($result)
                {
                    $_SESSION['id'] = $result['id'];
                    header("Location: /account");
                }
                else
                {
                    $this->view->loginError = "Invalid login";
                }
            }
        }
        $this->view->render("login");
    }

    public function logout()
    {
        session_unset();
        $this->view->render("login");
    }

    public function index()
    {
        echo 'index method of \'Auth\' class';
    }
}