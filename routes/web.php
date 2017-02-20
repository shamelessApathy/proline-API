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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/amazon', function(){
	return view('amazon');
});
Route::get('/amazon/get_order_list', "AmazonController@get_order_list");
Route::get('/amazon/get_report_list', "AmazonController@get_report_list");
Route::post('/amazon/get_report', "AmazonController@get_report");
Route::get('/amazon/request_report', "AmazonController@request_report");
Route::get('/amazon/get_status', "AmazonController@get_status");
//Route::get('/products', 'ProductController@index');
//Route::get('/products/add', function(){
//	return view('products/add');
//});
//Route::post('/products/store', 'ProductController@store');
//Route::post('/products/update', 'ProductController@update');
Route::get('/products/create', 'ProductController@create');
Route::get('products/{id}', 'ProductController@show');
Route::post('products/store', 'ProductController@store');
Route::get('test/send', 'Test@send');
Route::resource('products', 'ProductController');
