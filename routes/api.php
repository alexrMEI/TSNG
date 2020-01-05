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

Route::put('/doseadores/{doseadorId}/temperaturaAgua', 'AnimaisController@updateTemperaturaAgua');

Route::put('/doseadores/{doseadorId}/quantidadeAgua', 'AnimaisController@updateQuantidadeAgua');

Route::put('/doseadores/{doseadorId}/quantidadeComida', 'AnimaisController@updateQuantidadeComida');

Route::put('/doseadores', 'AnimaisController@identifiers');