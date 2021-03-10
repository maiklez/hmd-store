<?php

/*
|--------------------------------------------------------------------------
| Service - API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Prefix: /api/orders
Route::group(['prefix' => 'orders'], function() {

    // Controllers live in src/Services/OrdersManagement/Http/Controllers

    Route::get('/', 'OrderController@getOrders');
    Route::post('/', 'OrderController@createOrder');
    Route::get('/{id}', 'OrderController@readOrder');
    Route::put('/{id}', 'OrderController@updateOrder');
    Route::delete('/{id}', 'OrderController@deleteOrder');
    Route::post('/{id}/products', 'OrderController@addProducts');

});
