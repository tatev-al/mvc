<?php

namespace System;

class View
{
    public function render($file_name, $layout = true)
    {
        if(file_exists("Views" . DIRECTORY_SEPARATOR . "$file_name" . ".php"))
        {
            if($layout)
            {
                if(file_exists("Views" . DIRECTORY_SEPARATOR . "layouts" . DIRECTORY_SEPARATOR . "header.php") && file_exists("Views" . DIRECTORY_SEPARATOR . "layouts" . DIRECTORY_SEPARATOR . "footer.php"))
                {
                    include "Views" . DIRECTORY_SEPARATOR . "layouts" . DIRECTORY_SEPARATOR . "header.php";
                    include "Views" . DIRECTORY_SEPARATOR . $file_name . ".php";
                    include "Views" . DIRECTORY_SEPARATOR . "layouts" . DIRECTORY_SEPARATOR . "footer.php";
                }
                else
                {
                    echo "Header/Footer file(s) does not exists";
                }
            }
            else
            {
                include "Views" . DIRECTORY_SEPARATOR . $file_name . ".php";
            }
        }
        else
        {
            echo "Wrong file name";
        }
    }
}