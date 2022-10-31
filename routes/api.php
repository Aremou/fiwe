<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\CollectionController;
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

Route::get('/interest-center/{interest_center_id}/gallery', [InterestCenterController::class, 'gallery']);


//tourist Experiences
Route::get('/tourist-experiences', [TouristExperienceController::class, 'index']);



// Route::get('/about-us', [OtherController::class, 'about_us']);

Route::get('/privacy-policy', [OtherController::class, 'privacy_policy']);

Route::get('/terms-of-use', [OtherController::class, 'terms_of_use']);


Route::middleware('auth:sanctum')->group(function () {

    //Authentication
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    Route::get('/user', [UserController::class, 'user']);

    Route::post('/user/update-phone', [UserController::class, 'updatePhone']);

    Route::post('/user/update-password', [UserController::class, 'updatePassword']);

    Route::post('/user/update-information', [UserController::class, 'updateInformation']);

    Route::post('/user/update-notifications-settings', [UserController::class, 'updateNotificationsSettings']);

    Route::get('/user/meta', [UserController::class, 'meta']);

    Route::get('/user/contributions', [UserController::class, 'contributions']);


    //Interest Center Category
    Route::post('/interest-center-category', [InterestCenterCategoryController::class, 'store']);

    Route::put('/interest-center-category/{id}', [InterestCenterCategoryController::class, 'update']);

    Route::delete('/interest-center-category/{id}', [InterestCenterCategoryController::class, 'destroy']);


    //Interest Center
    Route::post('/interest-center', [InterestCenterController::class, 'store']);

    Route::put('/interest-center', [InterestCenterController::class, 'update']);

    Route::post('/interest-center/upload-image', [InterestCenterController::class, 'uploadImage']);

    Route::delete('/interest-center/delete-image-gallery', [InterestCenterController::class, 'deleteImageGallery']);

    Route::post('/interest-center/like', [InterestCenterController::class, 'like']);

    Route::delete('/interest-center/{id}', [InterestCenterController::class, 'destroy']);


    //tourist Experiences
    Route::post('/tourist-experience/payment', [TouristExperienceController::class, 'payment']);

    Route::post('/tourist-experience/like', [TouristExperienceController::class, 'like']);


    // Espace Me
    Route::post('/user/payement-statement', [UserController::class, 'payementStatement']);


    //Collections
    Route::get('/user/collections', [CollectionController::class, 'index']);

    Route::post('/user/collection', [CollectionController::class, 'store']);

    Route::put('/user/collection', [CollectionController::class, 'update']);

    Route::delete('/user/collection', [CollectionController::class, 'deleteCollection']);

    Route::post('/user/collection/images/add', [CollectionController::class, 'addImage']);

    Route::put('/user/collection/images/move', [CollectionController::class, 'moveImage']);

    Route::delete('/user/collection/image/delete', [CollectionController::class, 'deleteImage']);


});
