<?php

namespace B_directory;
use A_directory\A;

class B extends A
{
    function __construct()
    {
        parent::__construct();
        echo 'class B';
    }
}