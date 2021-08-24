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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'App\Http\Controllers'], function() {

    // Authentication/Register routes
    Route::group(['prefix' => 'auth'], function() {
        Route::get('/register', 'AuthController@register');
    });

    // Public endpoints
    Route::group(['prefix' => 'v1'], function() {
        Route::get('companies', 'CompanyController@index');
    });

    // Private routes
    Route::group(['middleware' => 'auth:sanctum'], function() {

    });
    // Route::resource('companies', CompanyController::class);
});

// Route::resource('people', App\Http\Controllers\PersonController::class);
// Route::resource('users', App\Http\Controllers\UserController::class);