<?php

use App\Models\Image;
use Illuminate\Support\Str;

if (!function_exists('save_image')) {
    function save_image($fieldname, $file1, $file2, $user)
    {
        $extension = new SplFileInfo($file1->getClientOriginalName());

        $filename = Str::random(16);

        $filepath = $file2->storeAs('user', $filename . '.' . $extension->getExtension(), 'public');

        if($filepath != null){
            $picture = Image::create([
                'filename' => $filename. '.' . $extension->getExtension(),
                'is_active' => 1,
                'user_id' => $user->id
            ]);
        }else{
            $picture = null;
        }

        return $picture;
    }
}







