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
Route::get('/cron/handle_data', 'CronController@handle_data');
Route::get('/cron/cron_test', 'CronController@cron_test');
Route::get('/cron/amazon', 'CronController@get_amazon_orders');
Route::get('/cron/handle_data', 'CronController@handle_data');
Route::get('/amazon', 'AmazonController@home');
Route::get('/home', 'HomeController@index');
Route::post('/amazon/get_order_list', "AmazonController@get_order_list")->name('order-list');
Route::get('/amazon/export_order_list', "AmazonController@ExportOrdersData");
Route::get('/amazon/save_orders', "AmazonController@SaveOrders");
Route::get('/amazon/get_report_list', "AmazonController@get_report_list");
Route::post('/amazon/get_report', "AmazonController@get_report");
Route::get('/amazon/request_report', "AmazonController@request_report");
Route::get('/amazon/get_status', "AmazonController@get_status");
// Route::get('/amazon/product_info/{asin}', "AmazonController@product_info");
Route::get('amazon/product_info/{asin}', 'ProductController@AmazonProductInfo')->name('product-info');
Route::get('amazon/product_list/{asin}', 'ProductController@AmazonProductList')->name('product-list');
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
Route::get('product-feed', 'ProductController@ProductFeed')->name('product-feed');
//<<<<<<< HEAD
/**** Walmart ******/
Route::get('walmart/products','WalmartController@index')->name('walmart');
Route::get('walmart/orders','WalmartController@OrderList')->name('walmart-orders');
Route::get('walmart/product-info/{id}','WalmartController@GetProductInfo')->name('walmart-product-info');

// Walmart lib test stuff
Route::get('/walmart', 'WalmartController@Index');
Route::get('/walmart/test', 'WalmartController@test');
Route::get('/walmart/order_list', 'WalmartController@order_list');


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/products/search', 'ProductController@search');

/************* Routes for Amazon API ************/
/*** Amazon Order Routes *****/
Route::get('amazon-data', 'AmazonController@AmazonData')->name('amazon-data');
Route::get('amazon-api-selection', 'ApiSelectionController@ApiSelection')->name('amazon-api-selection');
Route::get('amazon-api-operation', 'ApiSelectionController@ApiOperation')->name('amazon-api-operation');
Route::post('amazon/data', 'AmazonController@ApiFormAction')->name('api-form-action');
Route::get('amazon/amazon-list-orders', 'AmazonController@ListOrders')->name('amazon-list-orders');
Route::get('amazon/amazon-order-service-status', 'AmazonController@GetOrderServiceStatus')->name('amazon-order-service-status');
Route::get('amazon/amazon-get-order', 'AmazonController@GetOrder')->name('amazon-get-order');
Route::get('amazon/amazon-get-order-item', 'AmazonController@ListOrderItems')->name('amazon-get-order-item');
Route::get('amazon/amazon-export-orders', 'AmazonController@ExportOrders')->name('amazon-export-orders');
Route::get('amazon/amazon-order-info/{id}', 'AmazonController@GetOrderDetails')->name('amazon-order-info');

/***** Amazon Product Routes ****/
Route::get('amazon/amazon-product-service-status', 'ProductController@GetProductServiceStatus')->name('amazon-product-service-status');
Route::get('amazon/amazon-product-get-price-sku', 'ProductController@GetMyPriceForSKU')->name('amazon-product-get-price-sku');

/***** Amazon Reports Routes ****/
Route::get('amazon/amazon-get-report', 'ReportController@GetReport')->name('amazon-get-report');
Route::get('amazon/amazon-get-report-list', 'ReportController@GetReportList')->name('amazon-get-report-list');
Route::get('amazon/amazon-get-report-info/{id}', 'ReportController@GetReportInfo')->name('amazon-get-report-info');
Route::get('amazon/amazon-get-report-request', 'ReportController@GetReportRequest')->name('amazon-get-report-request');
Route::get('amazon/amazon-get-report-request-list', 'ReportController@AmazonReportRequestList')->name('amazon-get-report-request-list');
Route::get('amazon/amazon-manage-report-schedule', 'ReportController@ManageReportSchedule')->name('amazon-manage-report-schedule');
Route::get('amazon/amazon-get-report-schedule-list', 'ReportController@GetReportScheduleList')->name('amazon-get-report-schedule-list');

/**** Amazon Feed Routes *****/
Route::get('amazon/amazon-get-feed-list', 'FeedController@GetFeedSubmissionList')->name('amazon-get-feed-list');
Route::get('amazon/amazon-get-feed-result', 'FeedController@GetFeedSubmissionResult')->name('amazon-get-feed-result');
Route::get('amazon/amazon-get-feed-submit', 'FeedController@SubmitFeed')->name('amazon-get-feed-submit');

Route::get('amazon/amazon-update-feed', 'FeedController@UpdateAmazonInventory')->name('amazon-update-feed');