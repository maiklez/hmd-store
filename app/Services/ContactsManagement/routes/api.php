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

// Prefix: /api/contacts
Route::group(['prefix' => 'contacts'], function() {

    // Controllers live in src/Services/ContactsManagement/Http/Controllers

    Route::get('/', 'ContactController@getContacts');
    Route::post('/', 'ContactController@createContact');
    Route::get('/{id}', 'ContactController@readContact');
    Route::put('/{id}', 'ContactController@updateContact');
    Route::delete('/{id}', 'ContactController@deleteContact');

});
