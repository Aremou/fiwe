<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Account;
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
                'user_id' => $user->id
            ]);

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $tokenResult,
                'token_type' => 'Bearer',
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

            do {
                $code = rand(100000, 999999);

                $code_exist = User::where('phone_verified', $code)->first();
            } while ( $code_exist != null);

            $user->update([
                'phone_verified' => $code,
            ]);

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
                'codePhone' => 'required',
            ]);

            if($validatePhone->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePhone->errors()
                ], 401);
            }

            $user = User::where('phone_verified', $request->codePhone)->first();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Code Phone Successfully',
                    'codePhone' => $request->codePhone,
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePhone->errors()
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
                'password' => $this->passwordRules(),
                'codePhone' => 'required'
            ]);

            if($validatePassword->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePassword->errors()
                ], 401);
            }

            $user = User::where('phone_verified', $request->codePhone)->first();

            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                    'phone_verified' => null
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Password Successfully Update',
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePassword->errors()
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
