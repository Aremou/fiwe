<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InterestCenterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentification

Route::post('/auth/signup', [AuthController::class, 'createUser']);

Route::post('/auth/signin', [AuthController::class, 'loginUser']);

Route::post('/auth/verify-account', [AuthController::class, 'verifyAccountUser']);

Route::post('/auth/reset-password', [AuthController::class, 'resetPasswordUser']);

Route::get('/interest-center-category', [InterestCenterCategoryController::class, 'index']);

Route::get('/interest-center', [InterestCenterController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {


    //Interest Center Category
    Route::post('/interest-center-category', [InterestCenterCategoryController::class, 'store']);

    Route::get('/interest-center-category/{id}/show', [InterestCenterCategoryController::class, 'show']);

    Route::put('/interest-center-category/{id}/update', [InterestCenterCategoryController::class, 'update']);

    Route::delete('/interest-center-category/{id}/destroy', [InterestCenterCategoryController::class, 'destroy']);


    //Interest Center
    Route::post('/interest-center', [InterestCenterController::class, 'store']);

    Route::get('/interest-center/user/{id}', [InterestCenterController::class, 'interest_center_user']);

    Route::get('/interest-center/admin', [InterestCenterController::class, 'interest_center_admin']);

    Route::get('/interest-center/{id}/show', [InterestCenterController::class, 'show']);

    Route::put('/interest-center/{id}/update', [InterestCenterController::class, 'update']);

    Route::delete('/interest-center/{id}/destroy', [InterestCenterController::class, 'destroy']);

});
