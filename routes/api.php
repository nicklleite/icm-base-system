<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['prefix' => 'v1', 'as' => 'api.'], function() {
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('login.reset');

    Route::middleware('auth:sanctum')->group(function() {
        Route::resource('companies', CompanyController::class)->except(['create', 'edit']);
        Route::resource('people', PersonController::class)->except(['create', 'edit']);
        Route::resource('roles', RoleController::class)->except(['create', 'edit']);
        Route::resource('users', UserController::class)->except(['create', 'edit']);
    });
});
