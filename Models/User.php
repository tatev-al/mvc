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
    public function getUserName($id)
    {
        return $this->db->select("SELECT name FROM users WHERE id = $id", false);
    }
    public function userExists($email)
    {
        return $this->db->select("SELECT email FROM users WHERE email = '$email'", false);
    }
}