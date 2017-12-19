<?php

/*
 *
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
    return view('home');
})->name('home');


Route::get('/register', 'RegistrationControler@create');
Route::post('/register', 'RegistrationControler@store');

Route::get('/login', 'SessionsControler@create')->name('login');;
Route::post('/login', 'SessionsControler@store');

Route::get('/logout', 'SessionsControler@destroy');

Route::get('/palettes/all', 'PaletteController@showall');
Route::get('/palettes/my', 'PaletteController@showmy');
Route::get('/palettes/favourite', 'PaletteController@showmyfavourite');

Route::get('/palette/{palette}', 'PaletteController@editexisting');
Route::get('/palette','PaletteController@editnew');

Route::delete('/palette/{palette}', 'PaletteController@deletepalette');


Route::post('/palette/{palette}','PaletteController@save');
Route::post('/palette','PaletteController@savenew');

Route::post('/like/{palette}','PaletteController@like_palette');
Route::delete('/like/{palette}','PaletteController@unlike_palette');



