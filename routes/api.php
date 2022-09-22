<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\InterestCenterController;
use App\Http\Controllers\Api\TouristExperienceController;
use App\Http\Controllers\Api\InterestCenterCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Authentification

Route::post('/auth/signup', [AuthController::class, 'createUser']);

Route::post('/auth/signin', [AuthController::class, 'loginUser']);

Route::post('/auth/forget-password', [AuthController::class, 'forgetPasswordUser']);

Route::post('/auth/verify-account', [AuthController::class, 'verifyAccountUser']);

Route::post('/auth/reset-password', [AuthController::class, 'resetPasswordUser']);

Route::post('/send-sms-code', [AuthController::class, 'sendSmsCode']);

Route::post('/user/upload-image', [UserController::class, 'uploadImage']);





Route::get('/interest-center-categories', [InterestCenterCategoryController::class, 'index']);


//Interest Center
Route::get('/interest-centers', [InterestCenterController::class, 'index']);

Route::get('interest-center/{id}/gallery', [InterestCenterController::class, 'gallery']);


//tourist Experiences
Route::get('/tourist-experiences', [TouristExperienceController::class, 'index']);



Route::middleware('auth:sanctum')->group(function () {

    //Authentication
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    Route::get('/user', [UserController::class, 'user']);


    //Interest Center Category
    Route::post('/interest-center-category', [InterestCenterCategoryController::class, 'store']);

    Route::put('/interest-center-category/{id}', [InterestCenterCategoryController::class, 'update']);

    Route::delete('/interest-center-category/{id}', [InterestCenterCategoryController::class, 'destroy']);


    //Interest Center
    Route::post('/interest-center', [InterestCenterController::class, 'store']);

    Route::put('/interest-center/{id}', [InterestCenterController::class, 'update']);

    Route::post('interest-center/{id}/upload-image', [InterestCenterController::class, 'uploadImage']);

    Route::delete('interest-center/{id}/delete-image-gallery/{image}', [InterestCenterController::class, 'deleteImageGallery']);

    Route::post('interest-center/{id}/like', [InterestCenterController::class, 'like']);

    Route::delete('/interest-center/{id}', [InterestCenterController::class, 'destroy']);


    //tourist Experiences
    Route::post('/tourist-experience/{id}/payment', [TouristExperienceController::class, 'payment']);

});
