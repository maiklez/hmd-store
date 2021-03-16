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

// Prefix: /api/clients
Route::group(['prefix' => 'clients'], function() {

    // Controllers live in src/Services/ClientsManagement/Http/Controllers

    Route::get('/', 'ClientController@getClients');
    Route::post('/', 'ClientController@createClient');
    Route::get('/{id}', 'ClientController@readClient');
    Route::put('/{id}', 'ClientController@updateClient');
    Route::delete('/{id}', 'ClientController@deleteClient');

    Route::get('/orders/top-buyers', 'ClientController@getTopBuyers');

});
