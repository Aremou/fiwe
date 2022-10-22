<?php

use App\Models\Medias;


if (!function_exists('select_image')) {
    function select_image($id)
    {
        $image = Medias::find($id);
        if ($image) {
            return $image ;
        }else{
            return null;
        }
    }
}

if (!function_exists('image_path_interest_center')) {
    function image_path_interest_center()
    {
        return "storage/interest-centers/pictures/";
    }
}

if (!function_exists('galerie_path_interest_center')) {
    function galerie_path_interest_center()
    {
        return "storage/interest-centers/galeries/";
    }
}

if (!function_exists('picture_path_user')) {
    function picture_path_user()
    {
        return "storage/users/";
    }
}

if (!function_exists('image_path_tourist_experience')) {
    function image_path_tourist_experience()
    {
        return "storage/tourist-experiences/";
    }
}

if (!function_exists('delete_image_path')) {
    function delete_image_path($path, $name)
    {
        $path = public_path() . "/" . $path . $name;

        if(file_exists($path)){
            return unlink($path);
        }

    }
}
