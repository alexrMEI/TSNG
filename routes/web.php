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
//Animais
Route::get('/addAnimal', 'AnimaisController@addForm')->name('addAnimalForm');
Route::post('/saveAnimal', 'AnimaisController@guardarAnimal')->name('saveAnimal');
Route::get('/animal/{animal}', 'AnimaisController@viewAnimal')->name('viewAnimal');
Route::get('/animal/{animal}/agua', 'AnimaisController@addDoseadorAgua')->name('addDoseadorAgua');
Route::get('/animal/{animal}/comida', 'AnimaisController@addDoseadorComida')->name('addDoseadorComida');
Route::get('/animal/{animal}/agua/{doseador}', 'AnimaisController@updateDoseadorAgua')->name('updateDoseadorAgua');
Route::get('/animal/{animal}/comida/{doseador}', 'AnimaisController@updateDoseadorComida')->name('updateDoseadorComida');

Route::get('/delete/{id}', 'AnimaisController@deleteAnimal')->name('deleteAnimal');
Route::get('/deleteAgua/{id}', 'AnimaisController@deleteDoseadorAgua')->name('deleteDoseadorAgua');
Route::get('/deleteComida/{id}', 'AnimaisController@deleteDoseadorComida')->name('deleteDoseadorComida');