<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', ['as' => 'home', 'uses' => 'App\Controllers\HomeController@index']);
Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'App\Controllers\HomeController@detail']);
Route::get('all', ['as' => 'all', 'uses' => 'App\Controllers\HomeController@all']);

Route::get('login', ['as' => 'login', 'uses' => 'App\Controllers\Backend\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'App\Controllers\Backend\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'App\Controllers\Backend\AuthController@getLogout']);

Route::group(['before' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'App\Controllers\Backend\DashboardController@index']);
    Route::get('post', ['as' => 'post', 'uses' => 'App\Controllers\Backend\PostController@index']);
    Route::get('post', ['as' => 'post', 'uses' => 'App\Controllers\Backend\PostController@index']);
    Route::get('post/add', ['as' => 'post.add', 'uses' => 'App\Controllers\Backend\PostController@add']);
    Route::get('post/edit/{id}', ['as' => 'post.edit', 'uses' => 'App\Controllers\Backend\PostController@edit'])->where(['id' => '[0-9]+']);
    Route::post('post/store', ['as' => 'post.store', 'uses' => 'App\Controllers\Backend\PostController@store']);
    Route::put('post/update', ['as' => 'post.update', 'uses' => 'App\Controllers\Backend\PostController@update']);
    Route::get('post/destroy/{id}', ['as' => 'post.destroy', 'uses' => 'App\Controllers\Backend\PostController@destroy'])->where(['id' => '[0-9]+']);
});
