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

    Route::get('/index', 'ShopsController@index');
    Route::get('/shops/search', 'ShopsController@search');
    Route::get('/shops/result', 'ShopsController@result');
    Route::get('/road','ShopsController@show');

});
