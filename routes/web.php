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
Route::get('/amazon/export_order_list', "AmazonController@ExportOrdersData");
Route::get('/amazon/save_orders', "AmazonController@SaveOrders");
Route::get('/amazon/get_report_list', "AmazonController@get_report_list");
Route::post('/amazon/get_report', "AmazonController@get_report");
Route::get('/amazon/request_report', "AmazonController@request_report");
Route::get('/amazon/get_status', "AmazonController@get_status");
// Route::get('/amazon/product_info/{asin}', "AmazonController@product_info");
Route::get('amazon/product_info/{asin}', 'ProductController@AmazonProductInfo')->name('product-info');
Route::get('/amazon/render_view', "AmazonController@render_view");
//Route::get('/products', 'ProductController@index');
//Route::get('/products/add', function(){
//	return view('products/add');
//});
//Route::post('/products/store', 'ProductController@store');
//Route::post('/products/update', 'ProductController@update');
Route::get('/products/create', 'ProductController@create');
Route::get('products/{id}', 'ProductController@show')->name('product-data');
Route::post('products/store', 'ProductController@store');
Route::get('test/send', 'Test@send');
Route::get('products', 'ProductController@index')->name('product');
