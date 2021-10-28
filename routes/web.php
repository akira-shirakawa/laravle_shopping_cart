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
route::post('/sale/update','SaleController@update');
route::get('/search','CartController@search');