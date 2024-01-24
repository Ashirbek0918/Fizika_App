<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;

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
Route::post('user/login',[AuthController::class,'login']);
Route::post('login',[EmployeeController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::middleware('auth:sanctum')->group( function (){
    //user 
    Route::put('user/update',[AuthController::class,'update']);
    Route::get('logout',[AuthController::class,'logOut']);
    Route::get('getme',[AuthController::class,'getme']);
    //Course Controller
    Route::post('course/add',[CourseController::class,'add']);
});
