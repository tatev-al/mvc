<?php

$url_array = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
$ctrl_class = ucfirst($url_array[0]);
if(file_exists("Controllers" . DIRECTORY_SEPARATOR . $ctrl_class . ".php"))
{    
    spl_autoload_register(function($class_name){
		include "Controllers" . DIRECTORY_SEPARATOR . $class_name . ".php";
	});
     
    if(class_exists($ctrl_class))
    {
        $ctrl_object = new $ctrl_class;
        if (empty($url_array[1]))
        {
            if(method_exists($ctrl_object, 'index'))
            {
                $ctrl_object->index();
            }
            else
            {
                echo "Object created";
            }
        }
        else if(method_exists($ctrl_object, $url_array[1]))
        {
            $method = $url_array[1];
            $ctrl_object->$method();
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
