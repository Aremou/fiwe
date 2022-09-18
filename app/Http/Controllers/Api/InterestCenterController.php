<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Image;
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
        $interest_centers = InterestCenter::where('is_active', 1)->get();

        foreach ($interest_centers as $key => $interest_center){
            $interest_center->picture = select_image($interest_center->picture) != null ? asset(image_path_interest_center() . select_image($interest_center->picture)->filename) : null;

            $interest_center->with('users')->get();

            $interest_center->likes = count($interest_center->users);

            $t_interest_centers[$key] = $interest_center;

        }

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'items' => $t_interest_centers,
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
                'label'=> 'required',
                'description'=> 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'picture' => 'required|mimes:png,jpg,jpeg',
                'interest_center_category'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $label['fr'] = $request->label;
            $description['fr'] = $request->description;

            $save = save_image('interest-centers/pictures', $request->picture, $request->file('picture'), auth()->user());

            if( $save != null){
                InterestCenter::create([
                    'label' => json_encode($label),
                    'description' => json_encode($description),
                    'latitude' => create_location($request->latitude)->id,
                    'longitude' => create_location($request->longitude)->id,
                    'picture' => $save->id,
                    'user_id' => auth()->user()->id,
                    'interest_center_category_id' => $request->interest_center_category,
                    'is_active' => auth()->user()->role == "user" ? 0 : 1
                ]);
                return response()->json([
                    'status' => true,
                    'code' => self::OK,
                    'message' => 'Centre d\'interêt ajouté avec succès',
                ], 200);

            }

            return response()->json([
                'status' => false,
                'code' => self::INVALID_DATA,
                'message' => 'Image not uploaded'
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
                'label'=> 'required',
                'description'=> 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'interest_center_category'=> 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $interest_center = InterestCenter::find($id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $label['fr'] = $request->label;
            $description['fr'] = $request->description;

            $interest_center->update([
                'label' => json_encode($label),
                'description' => json_encode($description),
                'latitude' => edit_location($interest_center->latitude, $request->latitude)->id,
                'longitude' => edit_location($interest_center->longitude, $request->longitude)->id,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request, $id)
    {
        try {
            //Validated
            $validate = Validator::make($request->all(),
            [
                'interest_center_id' => 'required',
                'type'=> 'required|',
                'file'=> 'required|image|mimes:png,jpg,jpeg',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $interest_center = InterestCenter::find($request->interest_center_id);
            $user = User::find(auth()->user()->id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'User not found'
                ], 401);
            }

            if($request->type == "picture"){
                if ($interest_center->picture == null) {

                    $save = save_image('interest-centers/pictures', $request->file, $request->file('file'), $user);

                    if( $save!= null){

                        $interest_center->update([
                            'picture' => $save->id,
                        ]);

                        return response()->json([
                            'status' => true,
                            'code' => self::OK,
                            'message' => 'Image uploaded',
                        ], 200);

                    }else{
                        return response()->json([
                            'status' => false,
                            'code' => self::INVALID_DATA,
                            'message' => 'Image not uploaded'
                        ], 500);
                    }
                }else{
                    $image = Image::find($interest_center->picture);

                    if (!$image) {
                        return response()->json([
                            'status' => false,
                            'code' => self::NOT_FOUND,
                            'message' => 'Image not found'
                        ], 404);
                    }else{

                        delete_image_path(image_path_interest_center(), $image->filename);

                        $image->delete();

                        $save = save_image('interest-centers/pictures', $request->file, $request->file('file'), $user);

                        if($save != null){

                            $interest_center->update([
                                'picture' => $save->id,
                            ]);

                            return response()->json([
                                'status' => true,
                                'code' => self::OK,
                                'message' => 'Image uploaded',
                            ], 200);

                        }else{
                            return response()->json([
                                'status' => false,
                                'code' => self::NOT_FOUND,
                                'message' => 'Image not uploaded'
                            ], 500);
                        }
                    }
                }
            }else {

                $save = save_image('interest-centers/galeries', $request->file, $request->file('file'), $user);

                if( $save!= null){

                    $interest_center->images()->attach($save->id);

                    return response()->json([
                        'status' => true,
                        'code' => self::OK,
                        'message' => 'Image uploaded',
                    ], 200);

                }else{
                    return response()->json([
                        'status' => false,
                        'code' => self::INVALID_DATA,
                        'message' => 'Image not uploaded'
                    ], 500);
                }
            }
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
    public function gallery($id)
    {
        try {

            $interest_center = InterestCenter::find($id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $interest_center->with('images')->get();

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'path' =>galerie_path_interest_center(),
                'items' => $interest_center->images,
            ]);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteImageGallery($id, $image)
    {

        try {

            $image = Image::find($image);

            if (!$image) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Image  not found'
                ], 401);
            }

            $image->delete();

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'Image Deleted Successful',
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

            $interest_center = InterestCenter::find($id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $image = Image::find($interest_center->picture);

            // dd($image);
            if ($image != null) {
                $image->delete();
            }

            $interest_center->with('images')->get();

            foreach ($interest_center->images as  $img) {
                $image = Image::find($img->id);

                if ($image) {
                    $image->delete();
                }
            }

            $interest_center->delete();

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'Centre d\'interêt supprimé avec succès',
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
    public function like(Request $request, $id)
    {
        try {

            //Validated
            $validate = Validator::make($request->all(),
            [
                'interest_center_id' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $interest_center = InterestCenter::find($id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $interest_center->users()->toggle(auth()->user()->id);

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
