<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['web']], function () {

    // Route::auth();
    // Route::get('/login','UserController@content');
    Route::get('/search', 'ShopsController@search');
    Route::get('/result', 'ShopsController@result');
    Route::get('/navi/{id}','ShopsController@navi');
    Route::get('/showroad/{id}','ShopsController@');

});
