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
        $tourist_experiences = TouristExperience::where('is_active', 1)->get();

        // $t_tourist_experiences = [];

        foreach ($tourist_experiences as $key => $tourist_experience){
            $tourist_experience->picture = select_image($tourist_experience->picture) != null ? asset(image_path_tourist_experience() . select_image($tourist_experience->picture)->filename) : null;

            $tourist_experience->with('activities')->get();

            $tourist_experience->activities = $tourist_experience->activities;

            $t_tourist_experiences[$key] = $tourist_experience;
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

    public function payment(Request $request, $id){

        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'price'=> 'required',
                'disponibility'=> 'required',
                'transaction_id'=> 'required',
                'quantity'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $tourist = TouristExperience::findOrfail($id);

            UserExperience::create([
                'user_id' => auth()->user()->id,
                'tourist_experience_id' => $tourist->id,
                'price' => $request->price,
                'disponibility' => $request->disponibility,
                'status' => 'active',
                'transaction_id' => $request->transaction_id,
                'quantity' => $request->quantity,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Payement éffectué avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
