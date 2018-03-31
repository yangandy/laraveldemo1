<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::any('/upload', 'StudentController@upload');
Route::any('/mail', 'StudentController@mail');




Route::get('/','MainController@index');
Route::any('/detail/{productId}','MainController@detail');
Route::any('/myindex','MainController@myindex');



Route::get('/addProduct/{productId} ','CartController@addItem');
Route::get('/removeItem/{productId} ','CartController@removeItem');
Route::any('/cart','CartController@showCart');
Route::get('/max/{productId} ','CartController@max');
Route::any('/mid/{productId} ','CartController@mid');
Route::get('/min/{productId} ','CartController@min');


Route::any('/address','AddressController@show');
Route::any('/addaddress','AddressController@add');
Route::any('/delete/{addressId}','AddressController@delete');
Route::any('/update/{addressId}','AddressController@update');
Route::any('/status/{addressId}','AddressController@status');



Route::group(['middleware'=>['address']],function(){

    Route::post('/direct/{productId}','OrderController@direct');
    Route::any('/corder/{addressId} ','OrderController@corder');
    Route::any('/sorder ','OrderController@sorder');
    Route::any('/cartorder/{cart}','OrderController@direct');
    Route::any('/myorder','OrderController@myorder');
    Route::any('/unpayorder','OrderController@unpayorder');
    Route::any('/unexpress','OrderController@unexpress');
    Route::any('/evaluation','OrderController@evaluation');
});


Route::any('test111','CartController@index1');
Route::any('/wechat', 'WechatController@serve');






Route::get('/admin/product/new','ProductController@newProduct');
Route::get('/admin/product/products','ProductController@index');
Route::get('/admin/product/destroy/{id}','ProductController@destroy');
Route::any('/admin/product/update/{id}','ProductController@update');
Route::post('/admin/product/save','ProductController@add');

Route::any('/admin/order/all','OrderBcakController@all');
Route::any('/admin/order/unpay','OrderBcakController@unpay');

Route::any('/admin/order/express','OrderBcakController@express');
Route::any('/admin/order/refund','OrderBcakController@tuikuan');
Route::any('/admin/order/refund/{orderId}','OrderBcakController@refund');
Route::any('/admin/order/detail/{orderId}','OrderBcakController@detail');

Route::any('/admin/order/yiquxiao','OrderBcakController@yiquxiao');
Route::any('/admin/order/kuaidi/{orderId}','OrderBcakController@sendexpress');
Route::any('/admin/order/pay/{orderId}','OrderBcakController@delorder');
Route::any('/admin/order/pingjia/{orderId}','OrderBcakController@sendexpress');
Route::any('/admin/order/kuaidi/{orderId}','OrderBcakController@sendexpress');