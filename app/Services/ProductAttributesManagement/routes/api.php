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

// Prefix: /api/product-attributes
Route::group(['prefix' => 'product-attributes'], function() {

    // Controllers live in src/Services/ProductAttributesManagement/Http/Controllers

    Route::get('/', 'ProductAttributeController@getProductAttributes');
    Route::post('/', 'ProductAttributeController@createProductAttribute');
    Route::get('/{id}', 'ProductAttributeController@readProductAttribute');
    Route::put('/{id}', 'ProductAttributeController@updateProductAttribute');
    Route::delete('/{id}', 'ProductAttributeController@deleteProductAttribute');

});
