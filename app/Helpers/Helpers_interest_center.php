<?php

if (!function_exists('format_interest_center')) {
    function format_interest_center($interest_center)
    {
        $select_image = select_image($interest_center->image_id);
        $show_location = show_location($interest_center->geolocation_id);

        $interest_center->image_id =  $select_image != null ? asset(image_path_interest_center() . $select_image->filename) : null;

        $interest_center->with('users')->get();

        $interest_center->likes = count($interest_center->users);

        $interest_center->with('medias')->get();

        $t_interest_center_gallery = [];

        foreach ($interest_center->medias as $key => $image) {
            $t_interest_center_gallery[$key] = format_image_data(galerie_path_interest_center(), $image);
        }

        return [
            'id' => $interest_center->id,
            'label' => $interest_center->label,
            'description' => $interest_center->description,
            'image_url' => $interest_center->image_id,
            'latitude' => $show_location->latitude,
            'longitude' => $show_location->longitude,
            'user_id' => $interest_center->user_id,
            'likes' => $interest_center->likes,
            'is_active' => format_boolean($interest_center->is_active),
            'interest_center_category_id' => $interest_center->interest_center_category->id,
            'gallery' => $t_interest_center_gallery,
            'created_at' => $interest_center->created_at,
            'updated_at' => $interest_center->updated_at
        ];
    }
}
