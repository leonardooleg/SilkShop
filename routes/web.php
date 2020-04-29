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

Route::get('/','SiteController@welcome')->name('welcome');


Route::get('catalog/{category}/{product}.html', 'SiteController@product')->name('product')->where('category', '[a-zA-Z0-9\-/_]+');
Route::get('catalog/{path}', 'SiteController@category')->name('category')->where('path', '[a-zA-Z0-9\-/_]+');
Route::get('catalog', 'SiteController@catalog')->name('catalog');
Route::get('blog', 'SiteController@blogs')->name('blogs');
Route::get('blog/{url}.html', 'SiteController@blog')->name('blog');
Route::get('brands', 'SiteController@brands')->name('brands');
Route::get('brands/{url}.html', 'SiteController@brand')->name('brand');
Route::get('sizes', 'SiteController@sizes')->name('sizes');
Route::get('sizes/{url}.html', 'SiteController@size')->name('size');


Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['permission:admin']], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::get('/orders', 'DashboardController@orders')->name('admin');
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::get('/category/{id?}/children ', 'CategoryController@children')->name('admin');
    Route::resource('/colors', 'ColorController', ['as'=>'admin']);
    Route::resource('/providers', 'ProviderController', ['as'=>'admin']);
    Route::resource('/countries', 'CountryController', ['as'=>'admin']);
    Route::resource('/brands', 'BrandController', ['as'=>'admin']);
    Route::resource('/sizes', 'SizeController', ['as'=>'admin']);
    Route::resource('/products', 'ProductController', ['as'=>'admin']);
    Route::resource('/blogs', 'BlogController', ['as'=>'admin']);


    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function () {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
        Route::resource('/roles', 'RoleController', ['as' => 'admin.user_managment']);
    });
});

Route::get('home', function () {
    return redirect('/admin');
});
