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
        $userData = $user->getUserById($_SESSION['id']);
        if(empty($userData["avatar_img"]))
        {
            $user->uploadAvatar('avatar.png');
        }
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user->uploadAvatar($_POST['avatar_img']);
            $userData = $user->getUserById($_SESSION['id']);
        }
        $this->view->userName = $userData['name'];
        $this->view->userAvatar = $userData['avatar_img'];
        $this->view->render("account");
    }
}