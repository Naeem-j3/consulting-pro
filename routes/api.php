<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ExpertsResource;
use App\Models\Expert;
use App\Http\Controllers\ReservationController;



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
Route::middleware('auth:api')->get('/user', function () {
    return $request->user();
});


//login and regester for expert
Route::post('expert/login',[AuthController::class, 'expertLogin']);
Route::post('expert/register',[AuthController::class, 'expertRegister']);
//exopert auth 
Route::group( ['prefix' => 'expert','middleware' => ['auth:expert-api','scopes:expert'] ],function(){
    Route::get('logout',[AuthController::class, 'expertLogout']);
    Route::apiResource('/experts',ExpertController::class);
    Route::get('search/{name}',[ExpertController::class, 'search_expert_name']);
    Route::get('show_experts_has_consulat/{id}',[ExpertController::class, 'show_experts_has_consulat']);
    Route::get('expertPaidForExpert/{expert_id}',[WalletController::class, 'expertPaidForExpert']);
    Route::get('reservedDates',[ReservationController::class, 'reservedDates']);
    Route::get('showProfile',[ExpertController::class, 'showProfile']);
    Route::get('search',[ExpertController::class, 'search_expert_name']);
});


//login and regester for ueser
Route::post('user/login',[AuthController::class, 'userLogin']);
Route::post('user/register',[AuthController::class, 'userRegister']);

//exopert auth 
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here 
    Route::get('logout',[AuthController::class, 'userLogout']);
    Route::get('experts',[ExpertController::class, 'index']);
    Route::get('expert/{expert}',[ExpertController::class, 'show']);
    Route::get('search',[ExpertController::class, 'search_expert_name']);
    Route::get('show_experts_has_consulat/{id}',[ExpertController::class, 'show_experts_has_consulat']);
    Route::get('userPaidForExpert/{expert_id}',[WalletController::class, 'userPaidForExpert']);
    Route::post('reserve',[ReservationController::class, 'reserve']);
    Route::get('workDay/{expert}',[ReservationController::class, 'showDays']);
});

