<?php
namespace Helpers;

class Upload
{
    public $allowed_types = ["jpg", "png", "jpeg", "gif"];
    public $allowed_size = 2000000;
    public $errorUpload;

    public function upload($file_name, $target_dir)
    {
        $correctUpload = true;
        $imgFileType = strtolower(pathinfo($file_name["name"], PATHINFO_EXTENSION));
        $checkImg = getimagesize($file_name["tmp_name"]);

        if($checkImg)
        {
            $this->errorUpload = "File is not an image.";
            $correctUpload = false;
        }
        foreach($this->allowed_types as $value)
        {
            if($value == $imgFileType)
            {
                $this->errorUpload = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $correctUpload = true;
                break;
            }
        }
        if($file_name["size"] > $this->allowed_size)
        {
            $this->errorUpload = "Sorry, your file is too large.";
            $correctUpload = false;
        }
        if($correctUpload)
        {
            if(move_uploaded_file($file_name["tmp_name"], $target_dir))
            {
                return $correctUpload;
            }
            else
            {
                $correctUpload = false;
                $this->errorUpload = "Something went wrong";
            }
        }
        return $correctUpload;
    }
}