<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup',[UserController::class,'signup']);

Route::post('login',[UserController::class,'login']);

Route::get('getallproducts',[ProductController::class,'getAllProducts']);



Route::group(["middleware" => ["auth:api"]],function(){

    Route::get('getuserdata',[UserController::class,'getUserData']);

    Route::post('changeuserdata',[UserController::class,'changeUserData']);

    Route::post('addproduct',[ProductController::class,'addProduct']);

    Route::get('getmyproducts',[ProductController::class,'getMyProducts']);

    Route::delete('deletemyproducts/{id}',[ProductController::class,'deleteMyProducts']);

});
