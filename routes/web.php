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

// Route::get('/', function () {
//     return view('site.home');
// });
Auth::routes();

Route::get('/','SiteController@index')->name('site.index');
Route::get('login','SiteController@login')->name('site.login');


Route::get('product/getdata','ProductController@getdata')->name('product.getdata');
Route::get('product/getdata/{product_id}','ProductController@getdata')->name('product.getdatap');
Route::get('product/getprice/{product}','ProductController@getprice')->name('product.getprice');
Route::resource('product','ProductController');

Route::get('transaction/resume','TransactionController@resume')->name('transaction.resume');
Route::resource('transaction','TransactionController');
