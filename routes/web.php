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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['domain'=>'admin.'.parse_url(config('app.url'), PHP_URL_HOST),'middleware'=>'auth'], function() {

    //admin
    Route::get('/', 'Admin\GamesController@execute')->name('gamesList');

    //gameEdit;
    Route::group(['prefix'=>'edit','middleware'=>'auth'], function() {
            Route::get('{game}', ['uses'=>'Admin\GameEditController@getGame', 'as'=>'gameEdit']);
            Route::post('{game}', ['uses'=>'Admin\GameEditController@postGame', 'as'=>'gameEdit']);
            Route::delete('{game}', ['uses'=>'Admin\GameEditController@deleteGame', 'as'=>'gameDelete']);
            //delete relations
            Route::delete('attribute/{game}', ['uses'=>'Admin\GameEditController@deleteAttribute', 'as'=>'gameDeleteAttribute']);
        });
});

Route::group(['prefix'=>'parser'], function() {
    Route::group(['prefix'=>'bgg'], function() {
        Route::get('{game}', ['uses'=>'Parse\BGG@getBggInfo', 'as'=>'parseGameBgg']);
        Route::get('/all/{page}', ['uses'=>'Parse\BGG@getBggInfoAll', 'as'=>'gamesAllBgg']);
    });
    Route::group(['prefix'=>'tesera'], function() {
        Route::get('{game}', ['uses'=>'Parse\Tesera@getGameInfo', 'as'=>'parseGameTesera']);
        Route::get('/all/{page}', ['uses'=>'Parse\Tesera@getGamesAll', 'as'=>'gamesAllTesera']);
    });
});