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
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'App\Http\Controllers\AuthController@details');
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
        Route::get('details', 'App\Http\Controllers\AuthController@details');
    });
});

Route::get('customers', 'App\Http\Controllers\CustomerController@getAllCustomers');
Route::get('customers/{id}', 'App\Http\Controllers\CustomerController@getCustomer');
Route::post('customer/create', 'App\Http\Controllers\CustomerController@createCustomer');
Route::put('customers/{id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::delete('customers/{id}', 'App\Http\Controllers\CustomerController@deleteCustomer');


Route::get('services', 'App\Http\Controllers\ServiceController@getAllServices');
Route::post('service/create', 'App\Http\Controllers\ServiceController@store');
Route::get('service/{id}', 'App\Http\Controllers\ServiceController@getService');
Route::put('service/{id}', 'App\Http\Controllers\ServiceController@updateService');
Route::delete('service/{id}', 'App\Http\Controllers\ServiceController@deleteService');


Route::post('order/create', 'App\Http\Controllers\OrderController@store');
Route::get('orders', 'App\Http\Controllers\OrderController@index');
Route::get('orders/{id}', 'App\Http\Controllers\OrderController@getOrder');

Route::post('workorder/create', 'App\Http\Controllers\WorkOrderController@createWorkOrder');
Route::get('workorders', 'App\Http\Controllers\WorkOrderController@index');
Route::get('workorder/{id}', 'App\Http\Controllers\WorkOrderController@getOrder');
Route::put('workorder/{id}', 'App\Http\Controllers\WorkOrderController@updateWorkOrder');
Route::delete('workorder/{id}', 'App\Http\Controllers\WorkOrderController@deleteService');


Route::get('users', 'App\Http\Controllers\UsersController@getAllUsers');
Route::get('user/{id}', 'App\Http\Controllers\UsersController@getUser');
Route::post('user/create', 'App\Http\Controllers\UsersController@createUser');
Route::put('user/{id}', 'App\Http\Controllers\UsersController@updateUser');
Route::delete('user/{id}', 'App\Http\Controllers\UsersController@deleteUser');

