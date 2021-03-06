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
Auth::routes();
Route::get('/','ItemController@index');
Route::get('/item','ItemController@create');
Route::post('/item','ItemController@store');
Route::get('/item/edit/{id}','ItemController@edit');
Route::post('/item/delete','ItemController@destroy');
Route::post('/item/update','ItemController@update');
Route::post('/sale','SaleController@store');
Route::post('/cart','CartController@store');
Route::post('/sale/delete','SaleController@destroy');
Route::post('/cart/delete','CartController@destroy');
route::get('/cart','CartController@index');
route::get('/cart/{id}','CartController@edit');
route::post('/cart/update','CartController@update');
route::post('/sale/update','SaleController@update');
route::get('/search','CartController@search');
route::get('/ajax','AjaxController@index')->middleware('auth');
route::post('/ajax','AjaxController@store')->middleware('auth');
route::get('/getdata','AjaxController@getData')->middleware('auth');
route::post('/ajax/delete','AjaxController@destroy')->middleware('auth');
route::get('/ajax/{id}','AjaxController@isUnique');
Route::group(['prefix' => 'admin'], function() {
    
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});
 
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@index')->name('admin.home');
    Route::post('category','CategoryController@store');
    Route::post('category/delete','CategoryController@destroy');
    Route::get('category/{id}','CategoryController@edit');
    Route::post('category/update','CategoryController@update');
    Route::get('/user','Admin\HomeController@user');
    Route::get('/searchUserOnInput','Admin\HomeController@searchUserOnInput');
    route::get('/searchUser','Admin\HomeController@searchUser');
});
