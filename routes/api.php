<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/auth/login',[AuthController::class,'login']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::post('/auth/register',[AuthController::class, 'register']);
});

Route::group(['middleware'=>'auth:api'], function(){
    Route::apiResource('categories',CategoryController::class);
});



