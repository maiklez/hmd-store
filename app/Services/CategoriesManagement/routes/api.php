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

// Prefix: /api/categories
Route::group(['prefix' => 'categories'], function() {

    // Controllers live in src/Services/CategoriesManagement/Http/Controllers

    Route::get('/', 'CategoryController@getCategories');
    Route::post('/', 'CategoryController@createCategory');
    Route::get('/{id}', 'CategoryController@readCategory');
    Route::put('/{id}', 'CategoryController@updateCategory');
    Route::delete('/{id}', 'CategoryController@deleteCategory');

});
