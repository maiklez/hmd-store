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

// Prefix: /api/stores
Route::group(['prefix' => 'stores'], function() {

    // Controllers live in src/Services/StoresManagement/Http/Controllers

    Route::get('/', 'StoreController@getStores');
    Route::post('/', 'StoreController@createStore');
    Route::get('/{id}', 'StoreController@readStore');
    Route::put('/{id}', 'StoreController@updateStore');
    Route::delete('/{id}', 'StoreController@deleteStore');

    Route::get('/orders/top-sellers', 'StoreController@topSellers');
    Route::get('/orders/top-billing', 'StoreController@topBilling');
});
