<?php

use App\Models\Medias;
use Illuminate\Support\Str;

if (!function_exists('save_image')) {
    function save_image($dir, $file1, $file2, $user)
    {
        $extension = new SplFileInfo($file1->getClientOriginalName());

        $filename = Str::random(16);

        $filepath = $file2->storeAs($dir, $filename . '.' . $extension->getExtension(), 'public');


        if($filepath != null){
            $picture = Medias::create([
                'filename' => $filename. '.' . $extension->getExtension(),
                'mimetype' => $file1->getClientMimeType(),
                'is_active' => 1,
                'user_id' => $user->id
            ]);

        }else{
            $picture = null;
        }

        return $picture;
    }
}

if (!function_exists('update_image')) {
    function update_image($dir, $file1, $file2, $image)
    {
        $extension = new SplFileInfo($file1->getClientOriginalName());

        $filename = Str::random(16);

        $filepath = $file2->storeAs($dir, $filename . '.' . $extension->getExtension(), 'public');


        if($filepath != null){
            $picture = $image->update([
                'filename' => $filename. '.' . $extension->getExtension(),
                'mimetype' => $file1->getClientMimeType(),
                'is_active' => 1,
            ]);

        }else{
            $picture = null;
        }

        return $picture;
    }
}







