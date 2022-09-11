<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 401);
            }

            $tourist_experience->update([
                'label' => $request->label,
                'description' => $request->description,
                'city' => $request->city,
                'unit_price' => $request->unit_price,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Expérience touristique modifiée avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
