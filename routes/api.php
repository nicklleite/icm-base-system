<?php

use Illuminate\Http\Request;
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


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function() {
    Route::get('companies', 'CompanyController@index');
    // Route::resource('companies', CompanyController::class);
});

// Route::resource('people', App\Http\Controllers\PersonController::class);
// Route::resource('users', App\Http\Controllers\UserController::class);