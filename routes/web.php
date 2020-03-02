<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {

    //admin
    Route::get('/', 'Admin\GamesController@execute')->name('gamesList');
    Route::match(['get', 'post', 'delete'], '/search', ['uses'=>'Admin\GamesController@search', 'as'=>'gamesSearch']);
    Route::match(['get', 'post', 'delete'], '/edit/{game}', ['uses'=>'Admin\GameEditController@execute', 'as'=>'gameEdit']);
});