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

// Prefix: /api/products
Route::group(['prefix' => 'products'], function() {

    // Controllers live in src/Services/ProductsManagement/Http/Controllers

    Route::get('/', 'ProductController@getProducts');
    Route::post('/', 'ProductController@createProduct');
    Route::get('/{id}', 'ProductController@readProduct');
    Route::put('/{id}', 'ProductController@updateProduct');
    Route::delete('/{id}', 'ProductController@deleteProduct');

    Route::get('/types/{type}/values/{value}', 'ProductController@listProductAttributes');
    Route::get('/orders/best-sellers', 'ProductController@getProductsBestSellers');
});
