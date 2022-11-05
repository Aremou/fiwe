<?php

namespace App\Http\Controllers\Api;

use SplFileInfo;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TouristExperience;
use App\Http\Controllers\Controller;
use App\Models\UserExperience;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TouristExperienceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourist_experiences = TouristExperience::where('is_active', 1)->orderBy('created_at', 'DESC')->get();

        $t_tourist_experiences = [];

        foreach ($tourist_experiences as $key => $tourist_experience){
            $t_tourist_experiences[$key] = format_tourist_experience($tourist_experience);
        }

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'items' => $t_tourist_experiences,
        ]);
    }

    /**
     * Insert payment resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function payment(Request $request)
    {

        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'tourist_experience_id'=> 'required',
                'amount'=> 'required',
                'disponibility'=> 'required',
                'transaction_id'=> 'required',
                'quantity'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $tourist = TouristExperience::find($request->tourist_experience_id);

            if (!$tourist) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Tourist Experience not found'
                ], 404);
            }

            $user_experience = UserExperience::create([
                'user_id' => auth()->user()->id,
                'tourist_experience_id' => $tourist->id,
                'label' => $tourist->label,
                'amount' => $request->amount,
                'disponibility' => $request->disponibility,
                'status' => 'active',
                'transaction_id' => $request->transaction_id,
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'item' => format_user_experience($user_experience),
                'message' => 'Payement Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * like and unlike.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        try {

            $validateTouristExperience = Validator::make(
                $request->all(),
                [
                    'tourist_experience_id' => 'required',
                ]
            );

            if ($validateTouristExperience->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateTouristExperience->errors()
                ], 404);
            }

            $tourist_experience = TouristExperience::find($request->tourist_experience_id);

            if (!$tourist_experience) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Tourist Experience not found'
                ], 401);
            }

            $tourist_experience->users()->toggle(auth()->user()->id);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'like',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
