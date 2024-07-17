<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
    //get Profile
    Route::apiResource('users', UserController::class);


    Route::get('logout', [UserController::class, 'logout']);


Route::post('users', [UserController::class, 'store']);
Route::post('users/login', [UserController::class, 'login']);
