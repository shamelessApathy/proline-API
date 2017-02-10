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

//Route::get('/products', 'ProductController@index');
//Route::get('/products/add', function(){
//	return view('products/add');
//});
//Route::post('/products/store', 'ProductController@store');
//Route::post('/products/update', 'ProductController@update');
Route::get('/products/create', 'ProductController@create');
Route::get('products/{id}', 'ProductController@show');
Route::post('products/store', 'ProductController@store');
Route::resource('products', 'ProductController');