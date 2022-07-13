<?php

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

Route::prefix('auth')->as('auth:')->group(function () {
    Route::post('/login', App\Http\Controllers\Api\Auth\LoginController::class)->name('login');
    Route::post('/signin', App\Http\Controllers\Api\Auth\SignInController::class)->name('signin');
});
