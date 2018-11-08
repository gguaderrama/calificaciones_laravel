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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', array('as' => 'profile', 'uses' => 'RegistroController@index'));

// Route::get('calificaciones/delete/{user}', 'RegistroController@destroy');
Route::resource('/calificaciones', 'api\RegistroResourceController');




