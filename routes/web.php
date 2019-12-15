<?php

use App\Http\Middleware\CheckAdmin;

Route::get('register', 'Access\RegisterController@getRegister')->name('register');
Route::post('register', 'Access\RegisterController@postRegister');
Route::get('login', 'Access\LoginController@getLogin')->name('login');
Route::post('login', 'Access\LoginController@postLogin');
Route::get('logout', 'Access\LogoutController@getLogout')->name('logout');

Route::get('show/{id}','HomeController@show');

Route::resource('comments','CommentController');

Route::resource('posts', 'PostController');
Route::get('index', 'HomeController@index');
Route::post('posts/{id}','PostController@edit');

Route::post('search', 'PostController@search');

Route::resource('users', 'UsersController')->middleware(CheckAdmin::class);
Route::post('users/update', 'UsersController@update')->middleware(CheckAdmin::class);

Route::get('/', function () {
    return redirect()->action('HomeController@index');
});

Route::get('admin', function () {
    return redirect()->action('UsersController@index');
});

Route::get('user', function () {
    return redirect()->action('PostController@index');
});
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
