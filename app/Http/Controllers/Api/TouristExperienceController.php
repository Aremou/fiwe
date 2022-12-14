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

        $t_tourist_experiences = [];

        foreach ($tourist_experiences as $key => $tourist_experience){
            $tourist_experience->image_id = select_image($tourist_experience->image_id) != null ? asset(image_path_tourist_experience() . select_image($tourist_experience->image_id)->filename) : null;

            $tourist_experience->with('activities')->get();

            $t_tourist_experiences[$key] = [
                'id' => $tourist_experience->id,
                'label' => $tourist_experience->label,
                'description' => $tourist_experience->description,
                'city' => $tourist_experience->city,
                'unit_price' => $tourist_experience->unit_price,
                'image_url' => $tourist_experience->image_id,
                'latitude' => show_location($tourist_experience->geolocation_id)->latitude,
                'longitude' => show_location($tourist_experience->geolocation_id)->longitude,
                'activities' => $tourist_experience->activities
            ];
        }

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'items' => $t_tourist_experiences ?? $tourist_experiences,
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
                    'code' => self::INVALID_DATA,
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
                'code' => self::OK,
                'message' => 'Payement ??ffectu?? avec succ??s',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
