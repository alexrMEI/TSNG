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

Route::middleware('auth:api')->put('/animais/{animalId}/temperaturaAgua', 'AnimaisController@updateTemperaturaAgua');

Route::middleware('auth:api')->put('/animais/{animalId}/quantidadeAgua', 'AnimaisController@updateQuantidadeAgua');

Route::middleware('auth:api')->put('/animais/{animalId}/quantidadeComida', 'AnimaisController@updateQuantidadeComida');