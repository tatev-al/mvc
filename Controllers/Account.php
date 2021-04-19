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
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $imgFileType = strtolower(pathinfo($_FILES['avatar_img']['name'], PATHINFO_EXTENSION));
            $avatarNewName = time(). "." . $imgFileType;
            $target_dir = "./Public/Images/Avatars/" . $avatarNewName;
            $correctUpload = true;
            if(isset($_POST['submit']))
            {
                $check = getimagesize($_FILES['avatar_img']['tmp_name']);
                if($check !== false)
                {
                    $correctUpload = true;
                }
                else
                {
                    $this->view->imgUploadError = "File is not an image.";
                    $correctUpload = false;
                }
            }
            if($_FILES['avatar_img']['size'] > 2000000)
            {
                $this->view->imgSizeError = "Sorry, your file is too large.";
                $correctUpload = false;
            }
            if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif")
            {
                $this->view->imgTypeError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $correctUpload = false;
            }
            if($correctUpload && move_uploaded_file($_FILES['avatar_img']['tmp_name'], $target_dir))
            {
                $user->uploadAvatar($avatarNewName);
            }
        }
        $this->view->accountData = $user->getUserById($_SESSION['id']);
        if(empty($this->view->accountData) || !file_exists($this->view->accountData['avatar_img']))
        {
            $user->uploadAvatar('avatar.png');
            $this->view->accountData['avatar_img'] = 'avatar.png';
        }
        $this->view->render("account");
    }

    public function friends()
    {
        $user = new User;
        $this->view->friends = $user->getFriends($_SESSION["id"]);
        $this->view->render("friends");
    }
    public function user($id)
    {
        $user = new User;
        $this->view->accountData = $user->getUserById($id);
        $this->view->render('account');
    }
}