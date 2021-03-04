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

// Prefix: /api/attributes
Route::group(['prefix' => 'attributes'], function() {

    // Controllers live in src/Services/AttributesManagement/Http/Controllers

    Route::get('/', 'AttributeController@getAttributes');
    Route::post('/', 'AttributeController@createAttribute');
    Route::get('/{id}', 'AttributeController@readAttribute');
    Route::put('/{id}', 'AttributeController@updateAttribute');
    Route::delete('/{id}', 'AttributeController@deleteAttribute');

});
