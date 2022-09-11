<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InterestCenterCategory;
use Illuminate\Support\Facades\Validator;

class InterestCenterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'items' => InterestCenterCategory::all(),
        ]);
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
                'label_fr' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $label['fr'] = $request->label;

            InterestCenterCategory::create([
                'label' => json_encode($label['fr']),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Catégorie crée avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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
                'label' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $interest_center_category = InterestCenterCategory::findOrfail($id);

            if (!$interest_center_category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Interest Center category not found'
                ], 401);
            }

            $interest_center_category->update([
                'label' => $request->label,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Catégorie modifiée avec succès',
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

            $interest_center_category = InterestCenterCategory::findOrfail($id);

            if (!$interest_center_category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Interest Center category not found'
                ], 401);
            }

            $interest_center_category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Catégorie supprimée avec succès',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
