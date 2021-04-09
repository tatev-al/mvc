<?php

namespace Controllers;

class Home
{
    public function index()
    {
        echo "index method from 'Home' class";
    }
    public function test($x, $y)
    {
        echo 'param 1: ' . $x;
        echo '<br>param 2: ' . $y;
    }
    public function args()
    {
        $args = func_get_args();
        $i = 1;
        foreach ($args as $arg)
        {
            echo "Arg $i: $arg <br>";
            $i++;
        }
    }
}