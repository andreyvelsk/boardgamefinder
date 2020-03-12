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

    //gameEdit;
    Route::group(['prefix'=>'edit','middleware'=>'auth'], function() {
            Route::get('{game}', ['uses'=>'Admin\GameEditController@getGame', 'as'=>'gameEdit']);
            Route::post('{game}', ['uses'=>'Admin\GameEditController@postGame', 'as'=>'gameEdit']);
            Route::delete('{game}', ['uses'=>'Admin\GameEditController@deleteGame', 'as'=>'gameDelete']);
            //delete relations
            Route::group(['prefix'=>'delete','middleware'=>'auth'], function() {
                Route::delete('category/{game}', ['uses'=>'Admin\GameEditController@deleteCategory', 'as'=>'gameDeleteCategory']);
                Route::delete('mechanic/{game}', ['uses'=>'Admin\GameEditController@deleteMechanic', 'as'=>'gameDeleteMechanic']);
                Route::delete('family/{game}', ['uses'=>'Admin\GameEditController@deleteFamily', 'as'=>'gameDeleteFamily']);
                Route::delete('publisher/{game}', ['uses'=>'Admin\GameEditController@deletePublisher', 'as'=>'gameDeletePublisher']);
                Route::delete('type/{game}', ['uses'=>'Admin\GameEditController@deleteType', 'as'=>'gameDeleteType']);
        });
    });
});

Route::group(['prefix'=>'parser'], function() {
    Route::group(['prefix'=>'bgg'], function() {
        Route::get('{game}', ['uses'=>'Parse\Parser@getBggApi', 'as'=>'parseBgg']);
    });
});