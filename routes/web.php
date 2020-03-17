<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['permission:admin']], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::get('/orders', 'DashboardController@orders')->name('admin.index');
    /*Route::resource('/have-video', 'HaveVideoController', ['as' => 'admin']);
    Route::resource('/search-video', 'SearchVideoController', ['as' => 'admin']);*/

    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function () {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
        Route::resource('/roles', 'RoleController', ['as' => 'admin.user_managment']);
    });
});

Route::get('home', function () {
    return redirect('/admin');
});
