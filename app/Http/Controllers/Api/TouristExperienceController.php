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
        return TouristExperience::where('is_active', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'label'=> 'required',
                'description'=> 'required',
                'image'=> 'required',
                'city'=> 'required',
                'unit_price'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $touristExperience = TouristExperience::create([
                'label' => $request->label,
                'description' => $request->description,
                'city' => $request->city,
                'unit_price' => $request->unit_price,
            ]);

            $extension = new SplFileInfo($request->image->getClientOriginalName());

            $filename = Str::random(16);

            $filepath = $request->file('image')->storeAs('tourist_experiences', $filename . '.' . $extension->getExtension(), 'public');

            if($filepath != null){
                Image::create([
                    'contextid' => $touristExperience->id,
                    'component' => 'tourist_experiences',
                    'filename' => $filename. '.' . $extension->getExtension(),
                    'is_active' => 1,
                    'user_id' => auth()->user()->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Expérience touristique ajoutée avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TouristExperience::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'label'=> 'required',
                'description'=> 'required',
                'city'=> 'required',
                'unit_price'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $tourist_experience = TouristExperience::findOrfail($id);

            if (!$tourist_experience) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tourist Experience not found'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            TouristExperience::findOrfail($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Expérience touristique supprimée avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * Select all image.
     *
     * @param  int  $id
     * @param  string  $table
     */

    public function all_image($table, $id){

        $images = Image::where('contextid', $id)->where('component', $table)->get();

        return $images;
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
