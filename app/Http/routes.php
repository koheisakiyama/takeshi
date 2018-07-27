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

    Route::auth();
    Route::get('/search/login','UserController@login');
    Route::get('/complete','UserController@complete');
    Route::get('/search', 'ShopsController@search');
    Route::get('/result', 'ShopsController@result');
    Route::post('/result', 'UserController@store');
    Route::get('/select/{id}','ShopsController@select');
    Route::get('/navi/{id}','ShopsController@navi');
    Route::get('/users/{id}', 'UserController@show');
});
