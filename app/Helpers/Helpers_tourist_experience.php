<?php

use App\Models\Activity;
use App\Models\Geolocation;

if (!function_exists('geolocalion')) {
    function geolocalion($id)
    {
        $geolocation = Geolocation::find($id);

        return $geolocation ? $geolocation->altitude : '';
    }
}

if (!function_exists('activities')) {
    function activities()
    {
        return Activity::all();
    }
}














