<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/game', 'GameController', [
    'except' => ['edit', 'create', 'update']
]);
Route::get('/search/{search}', 'GameController@search')->name('searchGame');
Route::post('/recomendations', 'Recomendation\Recomendation@getRecomendations')->name('getRecomendation');