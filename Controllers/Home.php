<?php

namespace Controllers;

use System\Controller;
use Models\User;

class Home extends Controller
{
    public function index()
    {
        $user = new User;
        $this->view->users = $user->getAllUsers();
        $this->view->render("welcome");
    }
}