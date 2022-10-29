<?php

use App\Models\Medias;
use App\Models\Account;
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


if (!function_exists('format_user_data')) {
    function format_user_data($user)
    {
        $account = Account::where('user_id', $user->id)->first();
        $profile_image = select_image($user->profil_image_id);
        $cover_image = select_image($user->cover_image_id);

        return array(
            'id'=> $user->id,
            'fullname'=> $account->fullname,
            'birth_date'=> $account->birth_date,
            'civility'=> $account->civility,
            'birth_country'=> $account->birth_country,
            'profession'=> $account->profession,
            'badge'=> $account->badge,
            'game_level'=> $account->game_level,
            'experience_count'=> $account->experience_count,
            'certify'=> $account->certify,
            'pseudo'=> $user->name,
            'phone'=> $user->phone,
            'email'=> $user->email,
            'role'=> $user->role,
            'is_active'=> $user->is_active,
            'profile_image_url' => $profile_image ? asset(picture_path_user() . $profile_image->filename) : null,
            'cover_image_url' => $cover_image ? asset(picture_path_user() . $cover_image->filename) : null,
        );
    }
}







