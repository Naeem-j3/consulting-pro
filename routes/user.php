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

Route::post('user/login',[AuthController::class, 'userLogin']);
Route::post('user/register',[AuthController::class, 'userRegister']);
Route::get('h',function(){
    $e=Expert::find(11);
    return $e->days;
}
);

Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here 
    Route::get('logout',[AuthController::class, 'userLogout']);
    Route::get('experts',[ExpertController::class, 'index']);
    Route::get('experts/{expert}',[ExpertController::class, 'show']);
    Route::get('search/{id}',[ExpertController::class, 'search']);
});