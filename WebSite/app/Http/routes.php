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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'app.index', 'uses' => 'AppController@index']);

    Route::group(['prefix' => '/auth'], function(){
        Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);
    });

    Route::group(['prefix' => '/users'], function() {
        Route::get('profile', ['as' => 'users.profile', 'uses' => 'UsersController@profile']);
    });

    Route::group(['prefix' => '/tokens'], function() {
        Route::get('/', ['as' => 'tokens.index', 'uses' => 'TokensController@index']);
        Route::post('/', ['as' => 'tokens.store', 'uses' => 'TokensController@store']);
        Route::get('/{id}', ['as' => 'tokens.show', 'uses' => 'TokensController@show'])
             ->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => '/authenticator'], function() {
        Route::get('/{id}', ['as' => 'authenticator.show', 'uses' => 'AuthenticatorController@show'])
            ->where(['id' => '[0-9]+']);
    });
});

Route::group(['middleware' => 'guest'], function()
{
    Route::group(['prefix' => '/auth'], function() {
        Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
        Route::post('auth', ['as' => 'auth.auth', 'uses' => 'AuthController@auth']);
    });

    Route::group(['prefix' => '/users'], function() {
       Route::get('create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
       Route::post('/', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    });
});
