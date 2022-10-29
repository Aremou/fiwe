<?php

use App\Models\Activity;
use App\Models\Disponibility;
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

if (!function_exists('disponibilities')) {
    function disponibilities()
    {
        return Disponibility::all();
    }
}

if (!function_exists('format_tourist_experience')) {
    function format_tourist_experience($tourist_experience)
    {
        $select_image = select_image($tourist_experience->image_id);
        $show_location = show_location($tourist_experience->geolocation_id);

        $tourist_experience->image_id = $select_image != null ? asset(image_path_tourist_experience() . $select_image->filename) : null;

        $tourist_experience->with('activities')->get();

        $tourist_experience->with('disponibilities')->get();

        return [
            'id' => $tourist_experience->id,
            'label' => $tourist_experience->label,
            'description' => $tourist_experience->description,
            'city' => $tourist_experience->city,
            'unit_price' => $tourist_experience->unit_price,
            'image_url' => $tourist_experience->image_id,
            'latitude' => $show_location->latitude,
            'longitude' => $show_location->longitude,
            'activities' => $tourist_experience->activities,
            'disponibilities' => $tourist_experience->disponibilities,
            'created_at' => $tourist_experience->created_at,
            'updated_at' => $tourist_experience->updated_at
        ];
    }
}
