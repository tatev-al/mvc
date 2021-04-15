<?php

namespace Controllers;

use System\Controller;
use Models\User;

class Account extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION["id"]))
        {
            header('Location: /auth/login');
        }
        parent::__construct();
    }
    public function index()
    {
        $user = new User;
        $userData = $user->getUserName($_SESSION['id']);
        $this->view->userName = $userData['name'];
        $this->view->render("account");
    }
}