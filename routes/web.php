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


//admin routers
Route::get('/dashboard', 'AdminController@index');
Route::post('/loginAction', 'AdminController@loginAction');
Route::get('/login-form', 'AdminController@loginForm');
Route::get('/logout', 'AdminController@logout');

//items router
Route::get('/add-item', 'ItemController@index');
Route::post('/save-item', 'ItemController@store');
Route::get('/all-item', 'ItemController@all_items');
Route::get('/delete-item/{item_id}', 'ItemController@delete_item');
Route::get('/edit-item/{item_id}', 'ItemController@edit_item');
Route::post('/update-item/{item_id}', 'ItemController@update_item');
Route::get('/view-item/{item_id}', 'ItemController@show_item');


//clients routers
Route::get('/add-client', 'ClientController@index');
Route::post('/save-client', 'ClientController@store');
Route::get('/all-client', 'ClientController@all_clients');
Route::get('/edit-client/{client_id}', 'ClientController@edit_client');
Route::post('/update-client/{client_id}', 'ClientController@update_client');
Route::get('/view-client/{client_id}', 'ClientController@show_client');
Route::get('/delete-client/{client_id}', 'ClientController@delete_client');

//supplier routers
Route::get('/add-supplier', 'SupplierController@index');
Route::post('/save-supplier', 'SupplierController@store');
Route::get('/all-supplier', 'supplierController@all_suppliers');
Route::get('/edit-supplier/{supplier_id}', 'SupplierController@edit_supplier');
Route::post('/update-supplier/{supplier_id}', 'SupplierController@update_supplier');
Route::get('/view-supplier/{supplier_id}', 'SupplierController@show_supplier');
Route::get('/delete-supplier/{supplier_id}', 'SupplierController@delete_supplier');

//orders routes
Route::get('/all-orders', 'OrdersController@allOrders');
Route::get('/add-order', 'OrdersController@index');
Route::post('/save-order', 'OrdersController@store');
Route::get('/view-order/{order_id}', 'OrdersController@show_order');
Route::get('/delete-order/{order_id}', 'OrdersController@delete_order');





