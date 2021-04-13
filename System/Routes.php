<?php

namespace System;

class Routes
{
    public function __construct($path)
    {
        if(!empty($path[0]))
        {
            $ctrl_class = ucfirst($path[0]);
        }
        else
        {
            $ctrl_class = "Home";
        }
        if(file_exists("Controllers" . DIRECTORY_SEPARATOR . $ctrl_class . ".php"))
        {
            $ctrl_class_name = "Controllers\\" . $ctrl_class;
            if(class_exists($ctrl_class_name))
            {
                $ctrl_object = new $ctrl_class_name;
                if(!empty($path[1]))
                {
                    $method = $path[1];
                    if(method_exists($ctrl_object, $method))
                    {
                        $param_array = array_slice($path, 2);
                        $ctrl_object->$method(...$param_array);
                    }
                    else
                    {
                        echo "Method does not exist";
                    }
                }
                else
                {
                    if(method_exists($ctrl_object, 'index'))
                    {
                        $ctrl_object->index();
                    }
                    else
                    {
                        echo "Method 'index' does not exist";
                    }
                }
            }
            else
            {
                echo "Class does not exist";
            }
        }
        else
        {
            echo "Wrong adress";
        }
    }
}