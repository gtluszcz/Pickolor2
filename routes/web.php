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



//Palette
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

Route::post('/pcomments/new','PaletteController@addnewcomment');
Route::delete('/pcomments/{comment}','PaletteController@deletecomment');


//Colors
Route::get('/colors/all', 'ColorsController@showall');
Route::get('/colors/favourite', 'ColorsController@showmyfavourite');


Route::post('/likecolor/{color}','ColorsController@like_color');
Route::delete('/likecolor/{color}','ColorsController@unlike_color');

Route::get('/color/{color}', 'ColorsController@editexisting');
Route::get('/color','ColorsController@editnew');


Route::post('/ccomments/new','ColorsController@addnewcomment');
Route::delete('/ccomments/{comment}','ColorsController@deletecomment');

Route::post('/color','ColorsController@savenew');


