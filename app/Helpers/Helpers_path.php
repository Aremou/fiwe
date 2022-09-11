<?php

use App\Models\Image;


if (!function_exists('select_image')) {
    function select_image($id)
    {
        return Image::findOrfail($id);
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
        return "storage/user/";
    }
}

if (!function_exists('delete_image_path')) {
    function delete_image_path($path, $name)
    {
        return unlink(public_path() . "/" . $path . $name);
    }
}
