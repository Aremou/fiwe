<?php

if (!function_exists('format_collection')) {
    function format_collection($collection)
    {
        $collection->with('medias')->get();

        $t_collection_images = [];

        foreach ($collection->medias as $key => $image) {
            $t_collection_images[$key] = format_image_data(image_path_collection(), $image);
        }

        return [
            'id' => $collection->id,
            'label' => $collection->label,
            'cover_imahe_id' => $collection->cover_image_id,
            'user_id' => $collection->user_id,
            'images' => $t_collection_images,
            'created_at' => $collection->created_at,
            'updated_at' => $collection->updated_at
        ];
    }
}
