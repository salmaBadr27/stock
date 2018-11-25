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
Route::get('/delete-item', 'ItemController@delete_item');
Route::get('/edit-item/{item_id}', 'ItemController@edit_item');
Route::post('/update-item/{item_id}', 'ItemController@update_item');
Route::get('/view-item/{item_id}', 'ItemController@show_item');
Route::get('/view-item-by-cat/{category_id}', 'ItemController@show_item_by_category');
Route::get('/move-item-by-cat/{category_id}', 'ItemController@move_item');
Route::get('/delete-item-by-cat', 'ItemController@delete_item_by_cat_id');
Route::post('/update-item-by-cat/{category_id}', 'ItemController@update_item_by_cat');



//clients routers
Route::get('/add-client', 'ClientController@index');
Route::post('/save-client', 'ClientController@store');
Route::get('/all-client', 'ClientController@all_clients');
Route::get('/edit-client/{client_id}', 'ClientController@edit_client');
Route::post('/update-client/{client_id}', 'ClientController@update_client');
Route::get('/view-client/{client_id}', 'ClientController@show_client');
Route::get('/delete-client', 'ClientController@delete_client');
Route::get('/searchajaxClient', ['as'=>'searchajaxClient','uses'=>'OrdersController@search_client']);

//supplier routers
Route::get('/add-supplier', 'SupplierController@index');
Route::post('/save-supplier', 'SupplierController@store');
Route::get('/all-supplier', 'supplierController@all_suppliers');
Route::get('/edit-supplier/{supplier_id}', 'SupplierController@edit_supplier');
Route::post('/update-supplier/{supplier_id}', 'SupplierController@update_supplier');
Route::get('/view-supplier/{supplier_id}', 'SupplierController@show_supplier');
Route::get('/delete-supplier', 'SupplierController@delete_supplier');

//orders routes
Route::get('/all-orders', 'OrdersController@allOrders');
Route::get('/add-order', 'OrdersController@index');
Route::get('/searchajax', ['as'=>'searchajax','uses'=>'OrdersController@searchResponse']);
Route::post('/save-order', 'OrdersController@store');
Route::get('/view-order/{order_id}', 'OrdersController@show_order');
Route::get('/delete-order', 'OrdersController@delete_order');
Route::get('/search', 'OrdersController@search_client');
Route::get('/edit-order/{order_id}', 'OrdersController@edit_order');
Route::post('/update-order/{order_id}', 'OrdersController@update_order');

//units routes
Route::get('/add-unit', 'UnitsController@index');
Route::post('/save-unit', 'UnitsController@store');
Route::get('/delete-unit', 'UnitsController@delete_unit');
Route::get('/all-units', 'UnitsController@allUnits');
Route::get('/view-unit/{unit_id}', 'UnitsController@show_unit');
Route::get('/edit-unit/{unit_id}', 'UnitsController@edit_unit');
Route::post('/update-unit/{unit_id}', 'UnitsController@update_unit');


//purchases routes
 Route::get('/all-purchase', 'PurchasesController@allpurchases');
 Route::get('/add-purchase', 'PurchasesController@index');
 Route::get('/searchajax', ['as'=>'searchajax','uses'=>'PurchasesController@searchResponse']);
 Route::get('/searchajaxSupplier', ['as'=>'searchajaxSupplier','uses'=>'PurchasesController@search_supplier']);
 Route::post('/save-purchase', 'purchasesController@store');
 Route::get('/view-purchase/{purchase_id}', 'PurchasesController@show_purchase');
 Route::get('/delete-purchase', 'PurchasesController@delete_purchase');
 Route::get('/edit-purchase/{purchase_id}', 'PurchasesController@edit_purchase');
 Route::post('/update-purchase/{purchase_id}', 'PurchasesController@update_purchase');


//category routes
Route::get('/all-category', 'CategoryController@all_categories');
Route::get('/add-category', 'CategoryController@index');
Route::post('/save-category', 'CategoryController@store');
Route::get('/view-category/{category_id}', 'CategoryController@show_category');
Route::get('/view-sub-category/{category_id}', 'CategoryController@show_sub_category');
Route::get('/search', 'CategoryController@search_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::post('/update-sub-by-cat/{category_id}', 'CategoryController@update_sub_by_parent');
Route::get('/delete-category', 'CategoryController@delete_category');
Route::get('/delete-sub-category', 'CategoryController@delete_sub_category');
Route::get('/move-sub-by-cat/{category_id}', 'CategoryController@move_sub');

