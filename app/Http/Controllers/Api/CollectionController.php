<?php

namespace App\Http\Controllers\Api;

use App\Models\Medias;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function index(Request $request)
    {

        $collections = Collection::where('user_id', $request->user()->id)->get();

        $t_collections = [];

        foreach ($collections as $key => $collection) {
            $t_collections[$key] = format_collection($collection);
        }

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'items' => $t_collections,
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
            $validateCollection = Validator::make($request->all(),
            [
                'label' => 'required',
            ]);

            if($validateCollection->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateCollection->errors()
                ], 401);
            }

            $collection = Collection::create([
                'label' => $request->label,
                'user_id' => $request->user()->id
            ]);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'item' => $collection,
                'message' => 'Collection created successfully',
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
            $validateCollection = Validator::make($request->all(),
            [
                'collection_id' => 'required',
                'label' => 'required',
            ]);

            if($validateCollection->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateCollection->errors()
                ], 401);
            }

            $collection = Collection::find($request->collection_id);

            if (!$collection) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Collection not found'
                ], 401);
            }

            $collection->update([
                'label' => $request->label,
            ]);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'COllection updated successfully',
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
    public function deleteCollection(Request $request)
    {
        try {
            //Validated
            $validateCollection = Validator::make($request->all(),
            [
                'collection_id' => 'required',
            ]);

            if($validateCollection->fails()){
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateCollection->errors()
                ], 401);
            }
            $collection = Collection::find($request->collection_id);

            if (!$collection) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Collection not found',
                ], 401);
            }

            $collection->with('medias')->get();

            foreach ($collection->medias as  $img) {
                $image = Medias::find($img->id);

                if ($image) {
                    delete_image_path(image_path_collection(), $image->filename);

                    $image->delete();
                }
            }

            $collection->delete();

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'Collection deleted successfully',
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
    public function addImage(Request $request)
    {
        try {
            //Validated
            $validateImage = Validator::make(
                $request->all(),
                [
                    'collection_id' => 'required',
                    'file' => 'required|mimes:png,jpg,jpeg',
                ]
            );

            if ($validateImage->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateImage->errors()
                ], 404);
            }

            $collection = Collection::find($request->collection_id);

            if (!$collection) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Collection not found'
                ], 401);
            }

            $save = save_image('collections', $request->file, $request->file('file'), $request->user());

            if ($save == null) {

                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'Image not uploaded'
                ], 500);
            }

            $collection->medias()->attach($save->id);

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'image' => format_image_data(image_path_collection(), $save),
                'message' => 'Image uploaded',
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
    public function moveImage(Request $request)
    {
        try {
            //Validated
            $validateImage = Validator::make(
                $request->all(),
                [
                    'dest_collection_id' => 'required',
                    'image_id' => 'required',
                ]
            );

            if ($validateImage->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'validation error',
                    'errors' => $validateImage->errors()
                ], 404);
            }

            $image = Medias::find($request->image_id);

            if (!$image) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Image not found'
                ], 401);
            }

            $collection_media = DB::select('select * from collection_medias where medias_id = ?', [$image->id]);

            if (!$collection_media) {
                return response()->json([
                    'status' => false,
                    'code' => self::NOT_FOUND,
                    'message' => 'Item not found'
                ], 401);
            }

            $update_collection_media = DB::update('update collection_medias set collection_id = ? where medias_id = ?', [$request->dest_collection_id, $image->id]);

            if (!$update_collection_media) {

                return response()->json([
                    'status' => false,
                    'code' => self::INVALID_DATA,
                    'message' => 'Item not updated'
                ], 500);
            }

            return response()->json([
                'status' => true,
                'code' => self::OK,
                'message' => 'Item updated successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteImage(Request $request)
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

            delete_image_path(image_path_collection(), $image->filename);

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
}
