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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'cors'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('user', 'App\Http\Controllers\AuthController@user');
    });
});

Route::get('customers', 'App\Http\Controllers\CustomerController@getAllCustomers');
Route::get('customers/{id}', 'App\Http\Controllers\CustomerController@getCustomer');
Route::post('customers/create', 'App\Http\Controllers\CustomerController@createCustomer');
Route::put('customers/{id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::delete('customers/{id}', 'App\Http\Controllers\CustomerController@deleteCustomer');

