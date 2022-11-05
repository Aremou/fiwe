<?php

if (!function_exists('format_collection')) {
    function format_collection($collection)
    {
        $collection->with('medias')->get();

        $t_collection_images = [];

        foreach ($collection->medias as $key => $image) {
            $t_collection_images[$key] = format_image_data(image_path_collection(), $image);
        }

        $cover_image = select_image($collection->cover_image_id);

        return [
            'id' => $collection->id,
            'label' => $collection->label,
            'cover_image_url' => $cover_image ? asset(image_path_collection() . $cover_image->filename) : null,
            'user_id' => $collection->user_id,
            'images' => $t_collection_images,
            'created_at' => $collection->created_at,
            'updated_at' => $collection->updated_at
        ];
    }
}
