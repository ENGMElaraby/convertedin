<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], static function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], static function () {
    Route::get('/', static function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('search-user', 'UsersController@searchForUsers')->name('search.user');
    Route::resource('task', 'TasksController', ['except' => ['delete', 'update']]);
});