<?php

namespace System;

class Routes
{
    public function __construct($path)
    {
        if(!empty($path[0]))
        {
            $ctrl_class = ucfirst($path[0]);
            if(file_exists("Controllers\\" . $ctrl_class . ".php"))
            {
                $ctrl_class_name = "Controllers\\" . $ctrl_class;
                if(class_exists("Controllers\\" . $ctrl_class))
                {
                    $ctrl_class_name = "Controllers\\" . $ctrl_class;
                    $ctrl_object = new $ctrl_class_name;
                    if(!empty($path[1]))
                    {
                        $method = $path[1];
                        if(method_exists($ctrl_object, $method))
                        {
                            if(empty($path[2]))
                            {
                                $ctrl_object->$method();
                            }
                            else
                            {
                                $param_array = [];
                                for($i = 2; $i < count($path); $i++)
                                {
                                    $param_array[] = $path[$i];
                                }
                                $ctrl_object->$method(...$param_array);
                            }
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
                            echo "Object created";
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
                echo "Wrong URL";
            }
        }
        else
        {
            echo 'TODO';
        }
    }
}