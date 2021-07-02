<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
    Route::post('login', [LoginController::class, 'login']);
    Route::post('registerPublic', [RegisterController::class, 'registerPublic']);
    Route::post('registerServiceProvider', [RegisterController::class, 'registerServiceProvider']);
    Route::post('registerFunder', [RegisterController::class, 'registerFunder']);
    Route::post('logout', [LogOutController::class, 'logout']);


    Route::get('me', [MeController::class, 'me']);
});