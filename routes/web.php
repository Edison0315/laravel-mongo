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

Route::post('alumnos', 'HomeController@guardar');
Route::put('alumnos/{id}', 'HomeController@actualizar');
Route::delete('alumnos/{id}', 'HomeController@eliminar');

Route::get('/home',           'HomeController@index')->name('home');
Route::get('mostrar-alumno/{id}', 'HomeController@mostrar_alumnos');
