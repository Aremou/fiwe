<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    public function privacy_policy(){
        $privacy_policy = About::where('slug', slug_privacy_policy())->first();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'item' => $privacy_policy
        ]);
    }

    public function terms_of_use(){
        $terms_of_use = About::where('slug', slug_terms_of_use())->first();

        return response()->json([
            'status' => true,
            'code' => self::OK,
            'item' => $terms_of_use
        ]);
    }
}
