<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

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

Route::group(['prefix' => 'v1', 'as' => 'api.'], function() {
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');

    Route::middleware('auth:sanctum')->group(function() {
        Route::resource('users', UserController::class)->except(['edit']);
        Route::get("users/edit/{user}", [UserController::class, 'edit'])->name('users.edit');
    });
});
