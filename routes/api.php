<?php

use App\Http\Controllers\AcessController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', AcessController::class);
    Route::get('logout', [AcessController::class, 'logout']);
});

Route::post('users', [AcessController::class, 'store']);
Route::post('users/login', [AcessController::class, 'login']);
