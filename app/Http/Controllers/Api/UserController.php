<?php

namespace App\Http\Controllers\Api;

use SplFileInfo;
use App\Models\User;
use App\Models\Image;
use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function user(Request $request){

        $user = $request->user();

        $account = Account::where('user_id', $user->id)->first();

        $user_data = array(
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
            'phone'=> $user->phone,
            'email'=> $user->email,
            'role'=> $user->role,
            'is_active'=> $user->is_active,
            'profile_image_url' => select_image($user->profil_image_id) ? asset(picture_path_user() . select_image($user->profil_image_id)->filename) : null,
            'cover_image_url' => select_image($user->cover_image_id) ? asset(picture_path_user() . select_image($user->cover_image_id)->filename) : null,
            'is_active'=> 1
        );

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'User Info',
            'user' => $user_data,
        ], 200);
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'user_id'=> 'required',
                'type'=> 'required|',
                'file'=> 'required|image|mimes:png,jpg,jpeg',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            $fieldname = $request->type == "profil" ? 'profil_image_id' : 'cover_image_id';

            if ($user[$fieldname] == null) {

                $save = save_image('users', $request->file, $request->file('file'), $user);

                if( $save!= null){

                    $user->update([
                        $fieldname => $save->id,
                    ]);

                    return response()->json([
                        'status' => true,
                        'message' => 'Image uploaded',
                    ], 200);

                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Image not uploaded'
                    ], 500);
                }
            }else{
                $image = Image::find($user[$fieldname]);

                if (!$image) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Image not found'
                    ], 404);
                }else{

                    delete_image_path(picture_path_user(), $image->filename);

                    $image->delete();

                    $save = save_image('users', $request->file, $request->file('file'), $user);

                    if($save != null){

                        $user->update([
                            $fieldname => $save->id,
                        ]);

                        return response()->json([
                            'status' => true,
                            'message' => 'Image uploaded',
                        ], 200);

                    }else{
                        return response()->json([
                            'status' => false,
                            'message' => 'Image not uploaded'
                        ], 500);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
