<?php

namespace App\Http\Controllers\Api;

use SplFileInfo;
use App\Models\User;
use App\Models\Medias;
use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InterestCenter;
use App\Models\UserExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'pseudo'=> $user->name,
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
                        'image' => array(
                            'id' => $save->id,
                            'image_url' => asset(picture_path_user() . $save->filename),
                            'user_id' => $save->user_id
                        ),
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

                    $save = update_image('users', $request->file, $request->file('file'), $image);

                    if($save != null){

                        return response()->json([
                            'status' => true,
                            'code' => self::OK,
                            'image' => array(
                                'id' => $save->id,
                                'image_url' => asset(picture_path_user() . $save->filename),
                                'user_id' => $save->user_id
                            ),
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
                'id'=> $user_notifications_settings->id,
                'new_post'=> $user_notifications_settings->new_post ? true : false,
                'like_mention'=> $user_notifications_settings->like_mention ? true : false,
                'comments'=> $user_notifications_settings->comments ? true : false,
                'discussions_answers'=> $user_notifications_settings->discussions_answers ? true : false,
                'program_reminder'=> $user_notifications_settings->program_reminder,
                'new_tourist_experience'=> $user_notifications_settings->new_tourist_experience ? true : false,
                'nearby_players'=> $user_notifications_settings->nearby_players ? true : false,
                'share_experiences'=> $user_notifications_settings->share_experiences ? true : false,
                'repeat_unread_notifications'=> $user_notifications_settings->repeat_unread_notifications,
                'user_id'=> $user_notifications_settings->user_id,
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
            'interest_center_like' => $interest_centers,
            'tourist_experience_like' => $tourist_experiences,
            'user_notifications_settings' => $t_user_notifications_settings,
        );


        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'User Info',
            'meta' => $meta,
        ], 200);
    }

    public function contributions(Request $request)
    {

        $user = $request->user();

        $contributions = InterestCenter::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'Contributions User',
            'contributions' => $contributions,
        ], 200);

    }

    public function payementStatement(Request $request){
        $user = $request->user();

        $user_experiences = UserExperience::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'Payement Statement',
            'payement_statement' => $user_experiences,
        ], 200);
    }

    public function updatePhone(Request $request)
    {

        $user = $request->user();

        try {
            $validatePhone = Validator::make($request->all(),
            [
                'phone' => 'required',
            ]);

            if($validatePhone->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validatePhone->errors()
                ], 401);
            }

            if ($request->code == null) {

                $code = generate_code_user($user);

                try {

                    send_code_by_mail($user->email, $code);

                } catch (\Throwable $th) {
                    // ....
                }

                return response()->json([
                    'status' => true,
                    'code' => self::OK,
                    'user_id' => $user->id,
                    'message' => 'Code Send Your Phone Successfully',
                ], 200);
            }else{

                if ($user->phone_verified == $request->code) {
                    $user->update([
                        'phone' => $request->phone,
                        'phone_verified' => null
                    ]);

                    return response()->json([
                        'status' => true,
                        'code' => self::OK,
                        'message' => 'Phone Updated successfully',
                    ], 200);
                }else{
                    return response()->json([
                        'status' => false,
                        'code' => self::INVALID_DATA,
                        'message' => 'Provided verification code is incorrect',
                    ], 401);
                }
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function updateInformation(Request $request)
    {

        $user = $request->user();

        $validateUser = Validator::make($request->all(),
        [
            'fullname' => 'required',
            'birth_date' => 'required',
            'civility' => 'required',
            'birth_country' => 'required',
            'profession' => 'required',
            'email' => 'required',
            'pseudo' => 'required|unique:users,name,'.$user->id,
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'code' => self::INVALID_DATA,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $account = Account::where('user_id', $user->id)->first();

        $account->update([
            'fullname' => $request->fullname,
            'birth_date' => $request->birth_date,
            'civility' => $request->civility,
            'birth_country' => $request->birth_country,
            'profession' => $request->profession,
        ]);

        $user->update([
            'name' => $request->pseudo,
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'message' => 'User Updated Successfully',
        ], 200);

    }

    public function updatePassword(Request $request)
    {

        $user = $request->user();

        $validatePassword = Validator::make($request->all(),
        [
            'old_password' => 'required',
            'password' => 'required',
        ]);

        if($validatePassword->fails()){
            return response()->json([
                'status' => false,
                'code' => self::INVALID_DATA,
                'message' => 'validation error',
                'errors' => $validatePassword->errors()
            ], 401);
        }

        try {
            if((Hash::check($request->old_password, Auth::user()->password)) == false){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'Check your old password.',
                ], 401);
            }elseif ((Hash::check($request->password, Auth::user()->password)) == true) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'Please enter a password which is not similar then current password.',
                ], 401);
            }else{
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return response()->json([
                    'status' => false,
                    'code' => self::OK,
                    'message' => 'Password Updated successfully.',
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateNotificationsSettings(Request $request)
    {

        $user = $request->user();

        try {
            $user_notifications_settings = UserNotificationSetting::where('user_id', $user->id)->first();

            if (!$user_notifications_settings) {
                $user_notifications_settings = UserNotificationSetting::create([
                    'user_id' => $user->id
                ]);
            }

            $user_notifications_settings->update([
                $request->setting => $request->value
            ]);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'User Notifications Setting Successfully',
                'user_id' => $user->id
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


}
