<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login',[App\Http\Controllers\AuthController::class,'login']);
Route::post('logout',[App\Http\Controllers\AuthController::class,'logout']);
Route::post('register',[App\Http\Controllers\AuthController::class,'register']);
Route::post('check-token',[App\Http\Controllers\AuthController::class,'checkToken']);
Route::post('refresh-token',[App\Http\Controllers\AuthController::class,'refreshToken']);
Route::get('menu/show/{id}',[App\Http\Controllers\MenuController::class,'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('setting/{group}',[App\Http\Controllers\SettingController::class,'show_group'])->where([ 'group' => '[A-Za-z]+']);
    Route::post('work-order/create',[App\Http\Controllers\WorkOrderController::class,'create']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
