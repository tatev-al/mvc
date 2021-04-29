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
    public function sendMessage($id, $message)
    {
        $data = [
            "body" => $message,
            "from_id" => $_SESSION['id'],
            "to_id" => $id,
        ];
        return $this->db->insert("messages", $data);
    }
    public function getMessages($to_id, $lastId = 0)
    {
        $from_id = $_SESSION['id'];
        return $this->db->select("SELECT from_id, body, m.id, u.name, date 
                                        FROM messages as m 
                                        LEFT JOIN users as u ON m.from_id = u.id 
                                        WHERE ((from_id = $from_id AND to_id = $to_id) 
                                            OR (from_id = $to_id AND to_id = $from_id))
                                            AND m.id > $lastId ORDER BY m.id");
    }
    public function getLastSendMsg()
    {
        return $this->db->select("SELECT id, from_id, body, date from messages ORDER BY id DESC LIMIT 1", false);
    }
}