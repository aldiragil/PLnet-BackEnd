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


Route::controller(App\Http\Controllers\AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('register', 'register');
    Route::post('check-token', 'checkToken');
    Route::post('refresh-token', 'refreshToken');
});
// Route::post('login',[App\Http\Controllers\AuthController::class,'login']);
// Route::post('logout',[App\Http\Controllers\AuthController::class,'logout']);
// Route::post('register',[App\Http\Controllers\AuthController::class,'register']);
// Route::post('check-token',[App\Http\Controllers\AuthController::class,'checkToken']);
// Route::post('refresh-token',[App\Http\Controllers\AuthController::class,'refreshToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(App\Http\Controllers\WorkOrderController::class)->group(function() {
        Route::get('work-order/component','component');
        Route::get('work-order/list','list');
        Route::post('work-order/create','create');
        Route::put('work-order/update/{id}','update')->where([ 'id' => '[0-9]+' ]);
        Route::patch('work-order/status/{id}','status')->where([ 'id' => '[0-9]+' ]);
    });

    Route::controller(App\Http\Controllers\UserController::class)->group(function() {
        Route::get('user/list','list');
        Route::post('user/create','create');
        Route::put('user/update/{id}','update')->where([ 'id' => '[0-9]+' ]);
    });

    Route::controller(App\Http\Controllers\CustomerController::class)->group(function() {
        Route::get('customer/component','component');
        Route::get('customer/list','list');
        Route::post('customer/create','create');
        Route::put('customer/update/{id}','update')->where([ 'id' => '[0-9]+' ]);
    });

    Route::controller(App\Http\Controllers\SurveyController::class)->group(function() {
        Route::get('survey/component','component');
        Route::get('survey/list','list');
        Route::post('survey/create','create');
        Route::put('survey/update/{id}','update')->where([ 'id' => '[0-9]+' ]);
    });

    Route::controller(App\Http\Controllers\MenuController::class)->group(function() {
        Route::get('menu/all','getMenu');
        Route::get('menu/role','getRole');
        Route::get('menu/show-user/{id}','showByUser')->where([ 'id' => '[0-9]+' ]);
        Route::get('menu/show-role/{id}','showByRole')->where([ 'id' => '[0-9]+' ]);
        Route::post('menu/update-role','updateAccess');
    });

    Route::get('setting/{group}',[App\Http\Controllers\SettingController::class,'show_group'])->where([ 'group' => '[A-Za-z]+']);
    Route::get('menu/show/{tipe}/{id}',[App\Http\Controllers\MenuController::class,'show'])->where([ 'tipe' => '[0-9]+', 'id' => '[0-9]+' ]);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
