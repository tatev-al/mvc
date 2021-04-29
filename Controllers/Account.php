<?php

namespace Controllers;

use System\Controller;
use Models\User;
use Helpers\Upload;

class Account extends Controller
{
    private $user;
    public function __construct()
    {
        if(!isset($_SESSION["id"]))
        {
            header('Location: /auth/login');
        }
        parent::__construct();
        $this->user = new User;
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $upload = new Upload;
            $imgFileType = strtolower(pathinfo($_FILES["avatar_img"]["name"], PATHINFO_EXTENSION));
            $result = false;
            $avatarNewName = time() . "." . $imgFileType;
            $target_dir = "./Public/Images/Avatars/" . $avatarNewName;
            $result = $upload->upload($_FILES["avatar_img"], $target_dir);
            if($result)
            {
                $this->user->uploadAvatar($avatarNewName);
            }
            else
            {
                $this->view->errorUpload = $upload->errorUpload;
            }
        }
        $this->view->accountData = $this->user->getUserById($_SESSION['id']);
        if(!$this->view->accountData["avatar_img"])
        {
            $this->view->accountData['avatar_img'] = 'avatar.png';
        }
        $this->view->render("account");
    }

    public function friends()
    {
        $this->view->friends = $this->user->getFriends($_SESSION["id"]);
        $this->view->render("friends");
    }
    public function user($id)
    {
        $this->view->accountData = $this->user->getUserById($id);
        if(!$this->view->accountData["avatar_img"])
        {
            $this->view->accountData['avatar_img'] = 'avatar.png';
        }
        $this->view->render('account');
    }    
    public function chat($id)
    {
        $this->view->accountData = $this->user->getUserById($id);
        $this->view->messages = $this->user->getMessages($id);
        if(isset($_POST['chat']))
        {
            if($this->user->sendMessage($id, $_POST['chat']))
            {
                $getLastMsg1 = $this->user->getLastSendMsg($id);
                echo json_encode($getLastMsg1);
                exit;
            }
        }
        $this->view->render("chat");
    }
    public function getLastMessage($id, $lastMsgId)
    {
        $getLastMsg = $this->user->getMessages($id, $lastMsgId);
        echo json_encode($getLastMsg);
    }
}