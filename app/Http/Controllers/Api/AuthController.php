<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Account;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class AuthController extends Controller
{
    use PasswordValidationRules;
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'fullname' => 'required',
                'birth_date' => 'required',
                'civility' => 'required',
                'birth_country' => 'required',
                'birth_date' => 'required',
                'profession' => 'required',
                'phone' => 'required|unique:users,phone',
                'email' => 'required|email|unique:users,email',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'user',
            ]);

            Account::create([
                'fullname' => $request->fullname,
                'birth_date' => $request->birth_date,
                'civility' => $request->civility,
                'birth_country' => $request->birth_country,
                'profession' => $request->profession,
                'user_id' => $user->id
            ]);

            $code = generate_code_user($user);

            try {

                send_sms($request->phone, $code);

            } catch (\Throwable $th) {
                // print($th);
            }

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'phone' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'is_active' => 1])){
                return response()->json([
                    'status' => false,
                    'message' => 'Phone & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('phone', $request->phone)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Forget Password for User
     * @param Request $request
     * @return User
     */
    public function forgetPasswordUser(Request $request)
    {
        try {
            $validatePhone = Validator::make($request->all(),
            [
                'phone' => 'required',
            ]);

            if($validatePhone->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePhone->errors()
                ], 401);
            }

            $user = User::where('phone', $request->phone)->first();

            $code = generate_code_user($user);


            try {

                send_sms($request->phone, $code);

            } catch (\Throwable $th) {
                // print($th);
            }

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Account The User
     * @param Request $request
     * @return User
     */
    public function verifyAccountUser(Request $request)
    {
        try {
            $validatePhone = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'codePhone' => 'required',
            ]);

            if($validatePhone->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePhone->errors()
                ], 401);
            }

            $user = User::findOrfail($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }


            if ($user->phone_verified == $request->codePhone) {
                $user->update([
                    'is_active' => 1,
                    'phone_verified' => null
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Account Successfully actived',
                    'user_id' => $user->id
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Provided verification code is incorrect',
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Reset Password The User
     * @param Request $request
     * @return User
     */
    public function resetPasswordUser(Request $request)
    {
        try {
            $validatePassword = Validator::make($request->all(),
            [
                'password' => 'required',
                'user_id' => 'required'
            ]);

            if($validatePassword->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePassword->errors()
                ], 401);
            }

            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            if (!$user->is_active) {
                return response()->json([
                    'status' => false,
                    'message' => 'Inactive account'
                ], 401);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Password Successfully Updated',
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Send Sms Code
     * @param Request $request
     * @return User
     */
    public function sendSmsCode(Request $request)
    {
        try {
            $validateUserId = Validator::make($request->all(),
            [
                'user_id' => 'required',
            ]);

            if($validateUserId->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUserId->errors()
                ], 401);
            }

            $user = User::findOrfail($request->user_id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            $code = generate_code_user($user);

            try {

                send_sms($user->phone, $code);

            } catch (\Throwable $th) {

            }

            return response()->json([
                'status' => true,
                'message' => 'Code Send Successfully',
                'user_id' => $user->id
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Logout the user
     * @param Request $request
     */
    public function logoutUser(Request $request)
    {
        try {
            $validateUserId = Validator::make($request->all(),
            [
                'user_id' => 'required',
            ]);

            if($validateUserId->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUserId->errors()
                ], 401);
            }

            $user = Auth::user()->tokens()->delete();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Logout Successfully'
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
