<?php

namespace Models;

use System\Db;
use System\Model;

class User extends Model
{
    public function create($data)
    {
        $data['email'] = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $data['password'] = md5($data['password']);
        return $this->db->insert("users", $data);
    }
    public function login($email, $pass)
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $this->db->select("SELECT id FROM users WHERE email = '$email' AND password = '".md5($pass)."'", false);
    }
    public function getAllUsers()
    {
        return $this->db->select("SELECT * FROM users");
    }
    public function userExists($email)
    {
        return $this->db->select("SELECT email FROM users WHERE email = '$email'", false);
    }
    public function getUserById($id)
    {
        return $this->db->select("SELECT id, name, email, avatar_img FROM users WHERE id='$id'", false);
    }
    public function uploadAvatar($filename)
    {
        $newAvatar = [
            "avatar_img" => "$filename"
        ];
        return $this->db->where('id', $_SESSION['id'])->update("users", $newAvatar);
    }
    public function getFriends($id)
    {
        return $this->db->select("SELECT id, name, email, avatar_img FROM users WHERE NOT id = $id");
    }
    public function getMessages($id)
    {
        $from_id = $_SESSION['id'];
        return $this->db->select("SELECT from_id, body, date FROM messages WHERE (from_id = $id AND to_id = $from_id) OR (from_id = $from_id AND to_id = $id) ORDER BY date");
    }
}