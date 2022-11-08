<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Medias;
use Illuminate\Http\Request;
use App\Models\InterestCenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMailForInteresteCenterAddByUser;

class InterestCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interest_centers = InterestCenter::where('is_active', 1)->orderBy('created_at', 'DESC')->get();
        $t_interest_centers = [];

        foreach ($interest_centers as $key => $interest_center) {
            $t_interest_centers[$key] = format_interest_center($interest_center);
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
            $validate = Validator::make(
                $request->all(),
                [
                    'label' => 'required',
                    'description' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'file' => 'required|mimes:png,jpg,jpeg',
                    'interest_center_category' => 'required',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $label['fr'] = $request->label;
            $description['fr'] = $request->description;

            $auth_user = auth()->user();
            $save = save_image('interest-centers/pictures', $request->file, $request->file('file'), $auth_user);

            if ($save != null) {
                $interest_center = InterestCenter::create([
                    'label' => json_encode($label),
                    'description' => json_encode($description),
                    'geolocation_id' => create_location($request->latitude, $request->longitude)->id,
                    'image_id' => $save->id,
                    'user_id' => $auth_user->id,
                    'interest_center_category_id' => $request->interest_center_category,
                    'is_active' => $auth_user->role == "user" ? 0 : 1
                ]);

                Mail::to(env('MAIL_TO_ADDRESS'))->send(new SendMailForInteresteCenterAddByUser($interest_center));

                return response()->json([
                    'status' => true,
                    'code' => self::OK,
                    'item' => format_interest_center($interest_center),
                    'message' => 'Interest Center Created Successfully',
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
    public function update(Request $request)
    {
        try {
            //Validated
            $validate = Validator::make(
                $request->all(),
                [
                    'interest_center_id' => 'required',
                    'label' => 'required',
                    'description' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'interest_center_category' => 'required',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $interest_center = InterestCenter::find($request->interest_center_id);

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
                'geolocation_id' => edit_location($interest_center->geolocation_id, $request->latitude, $request->longitude)->id,
                'interest_center_category_id' => $request->interest_center_category,
            ]);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'Interest Center Updated Successfully',
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
    public function uploadImage(Request $request)
    {
        try {
            //Validated
            $validate = Validator::make(
                $request->all(),
                [
                    'interest_center_id' => 'required',
                    'type' => 'required',
                    'file' => 'required|mimes:png,jpg,jpeg',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $interest_center = InterestCenter::find($request->interest_center_id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $user = User::find(auth()->user()->id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'User not found'
                ], 401);
            }

            if ($request->type == "picture") {

                $image = Medias::find($interest_center->image_id);

                if (!$image) {
                    return response()->json([
                        'status' => false,
                        'code' => self::NOT_FOUND,
                        'message' => 'Image not found'
                    ], 404);
                }

                delete_image_path(image_path_interest_center(), $image->filename);

                $save = update_image('interest-centers/pictures', $request->file, $request->file('file'), $image);

                if ($save == null) {
                    return response()->json([
                        'status' => false,
                        'code' => self::NOT_FOUND,
                        'message' => 'Image not uploaded'
                    ], 500);
                }

                return response()->json([
                    'status' => true,
                    'code' => self::OK,
                    'image' => format_image_data(image_path_interest_center(), $image),
                    'message' => 'Image uploaded',
                ], 200);
            } else if ($request->type == "gallery") {

                $save = save_image('interest-centers/galeries', $request->file, $request->file('file'), $user);

                if ($save == null) {

                    return response()->json([
                        'status' => false,
                        'code' => self::INVALID_DATA,
                        'message' => 'Image not uploaded'
                    ], 500);
                }

                $interest_center->medias()->attach($save->id);

                return response()->json([
                    'status' => true,
                    'code' => self::OK,
                    'image' => format_image_data(galerie_path_interest_center(), $save),
                    'message' => 'Image uploaded',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'code' => self::INVALID_DATA,
                'message' => 'Invalid type provided. Expected picture | gallery'
            ], 500);
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
    public function gallery($interest_center_id)
    {
        try {

            $interest_center = InterestCenter::find($interest_center_id);

            if (!$interest_center) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Interest Center not found'
                ], 401);
            }

            $interest_center->with('medias')->get();

            $t_interest_center_gallery = [];

            foreach ($interest_center->medias as $key => $image) {
                $t_interest_center_gallery[$key] = format_image_data(galerie_path_interest_center(), $image);
            }

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'items' => $t_interest_center_gallery
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteImageGallery(Request $request)
    {
        try {
            //Validated
            $validate = Validator::make(
                $request->all(),
                [
                    'image_id' => 'required',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 404);
            }

            $image = Medias::find($request->image_id);

            if (!$image) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Image  not found'
                ], 401);
            }

            delete_image_path(galerie_path_interest_center(), $image->filename);

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
                    'messimageage' => 'Interest Center not found'
                ], 401);
            }

            $image = Medias::find($interest_center->image_id);

            if ($image != null) {

                delete_image_path(image_path_interest_center(), $image->filename);

                $image->delete();
            }

            $interest_center->with('medias')->get();

            foreach ($interest_center->images as  $img) {
                $image = Medias::find($img->id);

                if ($image) {
                    delete_image_path(galerie_path_interest_center(), $image->filename);

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
    public function like(Request $request)
    {
        try {

            $validateInterestCenter = Validator::make(
                $request->all(),
                [
                    'interest_center_id' => 'required',
                ]
            );

            if ($validateInterestCenter->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateInterestCenter->errors()
                ], 404);
            }

            $interest_center = InterestCenter::find($request->interest_center_id);

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
