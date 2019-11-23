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

Route::apiResources(['users' => 'Admin\UsersController']);
Route::apiResources(['products' => 'Products\ProductsController']);
Route::apiResources(['cart' => 'Cart\cartsController']);
Route::get('logout', 'Auth\LogoutController@logout');
Route::post('register', 'Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');
Route::post('sessionStart', 'SessionController@index');
Route::get('profile', 'Users/UsersController@profile');
Route::put('profile', 'Users/UsersController@updateProfile');
Route::get('findUser', 'Users/UsersController@search');
Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('CheckLoginStatus', 'Auth\LoginController@CheckLoginStatus');
    Route::get('logout', 'Auth\LogoutController@logout');
    Route::get('user', 'Auth\LoginController@user');

    // Route::get('home', 'HomeController@index');
});
