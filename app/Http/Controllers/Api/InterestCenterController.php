<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InterestCenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InterestCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InterestCenter::where('is_active', 1)->get();
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
                'lat'=> 'required',
                'long'=> 'required',
                'interest_center_category'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            InterestCenter::create([
                'label' => $request->label,
                'description' => $request->description,
                'lat' => $request->lat,
                'long' => $request->long,
                'user_id' => auth()->user()->id,
                'interest_center_category_id' => $request->interest_center_category,
                'is_active' => auth()->user()->role == "user" ? 0 : 1
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Centre d\'interêt ajouté avec succès',
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
        return InterestCenter::findOrfail($id);
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
                'lat'=> 'required',
                'long'=> 'required',
                'interest_center_category'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            InterestCenter::findOrfail($id)->update([
                'label' => $request->label,
                'description' => $request->description,
                'lat' => $request->lat,
                'long' => $request->long,
                'interest_center_category_id' => $request->interest_center_category,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Centre d\'interêt modifié avec succès',
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

            InterestCenter::findOrfail($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Centre d\'interêt supprimé avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
