<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantSettingController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);

Route::group(['middleware'=>'merchant','prefix'=>'merchant'],function(){
    Route::post('store-update-setting',[MerchantSettingController::class,'storeUpdateSetting']);
    Route::post('products',[ProductController::class,'store']);
    Route::get('products',[ProductController::class,'index']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
