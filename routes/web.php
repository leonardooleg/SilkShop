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
    Route::resource('/orders', 'OrdersController', ['as'=>'admin']);
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::get('/category/{id?}/children ', 'CategoryController@children')->name('admin');
    Route::resource('/colors', 'ColorController', ['as'=>'admin']);
    Route::resource('/providers', 'ProviderController', ['as'=>'admin']);
    Route::resource('/countries', 'CountryController', ['as'=>'admin']);
    Route::resource('/brands', 'BrandController', ['as'=>'admin']);
    Route::resource('/sizes', 'SizeController', ['as'=>'admin']);
    Route::resource('/products', 'ProductController', ['as'=>'admin']);
    Route::resource('/blogs', 'BlogController', ['as'=>'admin']);
    Route::get('/menu','MenuController@index')->name('menu.get');

    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function () {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
        Route::resource('/roles', 'RoleController', ['as' => 'admin.user_managment']);
    });
});

Route::get('home', function () {
    return redirect('/admin');
});


Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/cart','CartController@add')->name('cart.add');
Route::get('/cart/shipping','CartController@shipping')->name('cart.shipping');
Route::post('/cart/shipping','CartController@addShipping')->name('cart.addShipping');
Route::post('/cart/conditions','CartController@addCondition')->name('cart.addCondition');
Route::delete('/cart/conditions','CartController@clearCartConditions')->name('cart.clearCartConditions');
Route::get('/cart/details','CartController@details')->name('cart.details');
Route::get('/cart/update/{id}&{action}','CartController@update')->name('cart.update');
Route::delete('/cart/{id}','CartController@delete')->name('cart.delete');

Route::post('/cart2-details','Cart2Controller@go')->name('cart2.go')->middleware('auth');
Route::get('/cart2','Cart2Controller@index')->name('cart2.index')->middleware('auth');
Route::post('/cart2','Cart2Controller@add')->name('cart2.add')->middleware('auth');
/*Route::get('/cart-finish','Cart2Controller@finish')->name('cart3.finish')->middleware('auth');*/

Route::get('product-cart/{id?}', 'SiteController@productID')->name('productID');
