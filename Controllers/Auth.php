<?php

namespace Controllers;

class Auth
{
    public function test()
    {
          echo 'test \'Auth\' class';
    }
    public function index()
    {
        echo 'index method from \'Auth\' class';
    }
    public function print($var)
    {
        echo 'variable in Auth: ' . $var;
    }
}