<?php

$url_string = explode('/', $_SERVER['REQUEST_URI']);

if(file_exists("Controllers/" . $url_string[1] . ".php"))
{
    include "Controllers/" . $url_string[1] . ".php";
    if(class_exists($url_string[1]))
    {
        $object = new $url_string[1]();
        if(method_exists($object, $url_string[2]))
        {
            $method = $url_string[2];
            $object->$method();
        }
        else if ($url_string[2] == null)
        {
            echo "Object created";
        }
        else
        {
            echo "Method does not exist";
        }
    }
    else
    {
        echo "Class does not exist";
    }
}
else
{
    echo "Wrong URL";
}
