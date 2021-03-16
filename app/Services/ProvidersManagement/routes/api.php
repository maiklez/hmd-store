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

// Prefix: /api/providers
Route::group(['prefix' => 'providers'], function() {

    // Controllers live in src/Services/ProvidersManagement/Http/Controllers

    Route::get('/', 'ProviderController@getProviders');
    Route::post('/', 'ProviderController@createProvider');
    Route::get('/{id}', 'ProviderController@readProvider');
    Route::put('/{id}', 'ProviderController@updateProvider');
    Route::delete('/{id}', 'ProviderController@deleteProvider');


    Route::get('/{id}/products', 'ProviderController@getProductsProviders');
    Route::get('/orders/top-billing', 'ProviderController@getProvidersTopBilling');
});
