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
// Route::view('/{path?}', 'app')->where('path', '.*')->name('react');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
// Route::post('logout', 'Auth\LogoutController@index');
Route::get('logout', 'Auth\LogoutController@index')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}', 'HomeController@index')->where('path', '.*');
