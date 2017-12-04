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
    return view('home');
})->name('home');
Route::get('palette', function () {
    return view('palette');
});
Route::get('register', 'RegisterController@create');
Route::post('register', 'RegisterController@store');

Route::get('login', 'SessionsController@create');
