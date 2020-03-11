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
    //gameEdit
    Route::get('/edit/{game}', ['uses'=>'Admin\GameEditController@getGame', 'as'=>'gameEdit']);
    Route::post('/edit/{game}', ['uses'=>'Admin\GameEditController@postGame', 'as'=>'gameEdit']);
    Route::delete('/edit/{game}', ['uses'=>'Admin\GameEditController@deleteGame', 'as'=>'gameDelete']);
    //delete relations
    Route::delete('/edit/delete/category/{game}', ['uses'=>'Admin\GameEditController@deleteCategory', 'as'=>'gameDeleteCategory']);
    Route::delete('/edit/delete/mechanic/{game}', ['uses'=>'Admin\GameEditController@deleteMechanic', 'as'=>'gameDeleteMechanic']);
    Route::delete('/edit/delete/family/{game}', ['uses'=>'Admin\GameEditController@deleteFamily', 'as'=>'gameDeleteFamily']);
    Route::delete('/edit/delete/publisher/{game}', ['uses'=>'Admin\GameEditController@deletePublisher', 'as'=>'gameDeletePublisher']);
});