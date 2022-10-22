<?php

namespace App\Http\Controllers\Api;

use SplFileInfo;
use App\Models\User;
use App\Models\Medias;
use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Http\Controllers\Controller;
use App\Models\InterestCenter;
use App\Models\UserNotificationSetting;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function user(Request $request)
    {

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
                'type'=> 'required',
                'file'=> 'required|mimes:png,jpg,jpeg',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
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
                        'code' => self::OK,
                        'message' => 'Image uploaded',
                    ], 200);

                }else{
                    return response()->json([
                        'status' => false,
                        'code' => self::NOT_ACCESSIBLE,
                        'message' => 'Image not uploaded'
                    ], 500);
                }
            }else{
                $image = Medias::find($user[$fieldname]);

                if (!$image) {
                    return response()->json([
                        'status' => false,
                        'code' => self::NOT_FOUND,
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
                            'code' => self::OK,
                            'message' => 'Image uploaded',
                        ], 200);

                    }else{
                        return response()->json([
                            'status' => false,
                            'code' => self::NOT_ACCESSIBLE,
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


    public function meta(Request $request)
    {

        $user = $request->user();

        $user_notifications_settings = UserNotificationSetting::where('user_id', $user->id)->first();

        $t_user_notifications_settings = [];

        if($user_notifications_settings != null){
            $t_user_notifications_settings = [
                'id'=> $user_notifications_settings->id ? true : false,
                'new_post'=> $user_notifications_settings->new_post ? true : false,
                'like_mention'=> $user_notifications_settings->like_mention ? true : false,
                'comments'=> $user_notifications_settings->comments ? true : false,
                'discussions_answers'=> $user_notifications_settings->discussions_answers ? true : false,
                'program_reminder'=> $user_notifications_settings->program_reminder ? true : false,
                'new_tourist_experience'=> $user_notifications_settings->new_tourist_experience ? true : false,
                'nearby_players'=> $user_notifications_settings->nearby_players ? true : false,
                'share_experiences'=> $user_notifications_settings->share_experiences ? true : false,
                'repeat_unread_notifications'=> $user_notifications_settings->repeat_unread_notifications ? true : false,
                'user_id'=> $user_notifications_settings->user_id ? true : false,
            ];
        }

        $user->with('like_interest_centers')->get();
        $user->with('like_tourist_experiences')->get();

        $interest_centers = [];
        $tourist_experiences = [];

        foreach ($user->like_interest_centers as $key => $interest_center){
            $interest_centers[$key] = $interest_center->id;
        }
        foreach ($user->like_tourist_experiences as $key => $tourist_experience){
            $tourist_experiences[$key] = $tourist_experience->id;
        }

        $meta = array(
            'interest_center_like' => array($interest_centers),
            'tourist_experience_like' => array($tourist_experiences),
            'user_notifications_settings' => $t_user_notifications_settings,
        );


        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'User Info',
            'meta' => $meta,
        ], 200);
    }

    public function contributions(Request $request){

        $user = $request->user();

        $contributions = InterestCenter::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'Contributions User',
            'contributions' => $contributions,
        ], 200);

    }

    public function payement_statement(Request $request){
        $user = $request->user();

        $user_experiences = UserExperience::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'Payement Statement',
            'payement_statement' => $user_experiences,
        ], 200);
    }
}
