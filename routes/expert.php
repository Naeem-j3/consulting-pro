<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
Route::post('expert/login',[AuthController::class, 'expertLogin']);
Route::post('expert/register',[AuthController::class, 'expertRegister']);

Route::group( ['prefix' => 'expert','middleware' => ['auth:expert-api','scopes:Expert'] ],function(){
    Route::get('logout',[AuthController::class, 'expertLogout']);
    Route::apiResource('/experts',ExpertController::class);
    Route::get('search/{id}',[ExpertController::class, 'search']);
});