<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\MedicamentController;
use App\http\Controllers\AuthController;



// Public routes

Route::post('/register',[AuthController::Class ,'register']);
Route::post('/login',[AuthController::Class ,'login']);

// Protected routes
Route::group(['middleware' =>['auth:sanctum']], function(){

    // User
    Route::get('/user',[AuthController::Class ,'user']);
    Route::post('/logout',[AuthController::Class ,'logout']);
    Route::post('/admin/assign-role',[AuthController::Class ,'assignRole']);




});

Route::apiResource('/medicament', MedicamentController::class);