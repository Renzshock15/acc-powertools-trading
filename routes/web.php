<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
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

// --------------- Pages Route ------------------------->
Route::get('/', 'PagesController@index');
Route::get('contact-us', 'PagesController@contact_us');
Route::get('registration', 'PagesController@registration');
Route::get('brands', 'PagesController@brands');
Route::get('access_denied', 'PagesController@access_denied');
// --------------- End Pages Route --------------------->

// --------------- Auth Route --------------------------->
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// --------------- End Auth Route ----------------------->

// --------------- Office Route ------------------------->
Route::get('/office/dashboard', 'OfficesController@index')->name('office.dashboard');
Route::get('/office/fetch_store_sales_data', 'OfficesController@fetch_store_sales_data');
Route::get('/office/fetch_stocks_data', 'OfficesController@fetch_stocks_data');
Route::get('/office/profile', 'OfficesController@profile');
Route::get('/office/product', 'OfficesController@product')->name('office.product');
Route::post('/office/product', 'OfficesController@product')->name('office.product');
Route::get('/office/create', 'OfficesController@create_product')->name('office.create');
Route::post('/office/create', 'OfficesController@store_product')->name('office.store');
Route::post('/office/image', 'OfficesController@upload_image')->name('office.upload_image');
Route::get('/office/product-info/{id}', 'OfficesController@product_info')->name('office.product_info');
Route::post('/office/product-info/{id}', 'OfficesController@update_product')->name('office.product_info');
Route::post('/office/product/{id}', 'OfficesController@delete_product')->name('office.delete');
Route::get('/office/profile_photo', 'OfficesController@profile_photo');
Route::post('/office/upload_profile', 'OfficesController@upload_profile');
Route::post('/office/save_image', 'OfficesController@save_image');
Route::post('/office/save_username', 'OfficesController@save_username');
Route::post('/office/save_password', 'OfficesController@save_password');
Route::get('/office/user_info', 'OfficesController@user_info');
Route::get('/office/inventory', 'OfficesController@inventory');
Route::get('/office/transaction', 'OfficesController@transaction');
Route::get('/office/fetch_inventory_data', 'OfficesController@fetch_inventory_data');
Route::get('/office/submit_activateDeactivate', 'OfficesController@submit_activateDeactivate');
Route::get('/office/fetch_data_for_transaction', 'OfficesController@fetch_data_for_transaction');
Route::get('/office/transacted_items/{transaction_id}', 'OfficesController@transacted_items');
Route::get('/office/generate_transaction_pdf/{transaction_id}', 'OfficesController@generate_transaction_pdf');
Route::get('/office/stock_receive', 'OfficesController@stock_receive');
Route::get('/office/fetch_data_for_receive', 'OfficesController@fetch_data_for_receive');
Route::get('/office/receive_stocks/{transaction_id}', 'OfficesController@receive_stocks');
Route::post('/office/recieved_items', 'OfficesController@recieved_items');
Route::get('/office/factory_defect', 'OfficesController@factory_defect');
Route::get('/office/create_factory_defect', 'OfficesController@create_factory_defect');
Route::post('/office/save_return', 'OfficesController@save_return');
Route::get('/office/return_to_supplier_pdf/{id}', 'OfficesController@return_to_supplier_pdf');
Route::get('/office/update_return_to_supplier', 'OfficesController@update_return_to_supplier');
Route::get('/office/fetch_product_data', 'OfficesController@fetch_product_data');
// Route::get('/office/cancel_return_items', 'OfficesController@cancel_return_items');
// Route::post('/office/inventory', 'OfficesController@inventory');
Route::post('/office/chart_data', 'OfficesController@chart_data');
Route::get('/office/users', 'OfficesController@users')->middleware('administrator');
Route::post('/office/users', 'OfficesController@users')->middleware('administrator');
Route::get('/office/edit_user/{user_id}', 'OfficesController@edit_user')->middleware('administrator');
Route::post('/office/update_user', 'OfficesController@update_user')->middleware('administrator');
Route::get('/office/new_user', 'OfficesController@new_user')->middleware('administrator');
Route::post('/office/save_user', 'OfficesController@save_user')->middleware('administrator');
Route::get('/office/recovery/{user_id}', 'OfficesController@recovery')->middleware('administrator');
Route::post('/office/recover_user', 'OfficesController@recover_user')->middleware('administrator');
Route::get('/office/locations', 'OfficesController@locations')->middleware('administrator');
Route::get('/office/fetch_store_data', 'OfficesController@fetch_store_data')->middleware('administrator');
Route::get('/office/edit_store/{store_id}', 'OfficesController@edit_store')->middleware('administrator');
Route::post('/office/update_locations', 'OfficesController@update_locations')->middleware('administrator');
Route::get('/office/new_location', 'OfficesController@new_location')->middleware('administrator');
Route::post('/office/save_location', 'OfficesController@save_location')->middleware('administrator');
Route::get('/office/brands', 'OfficesController@brands');
Route::post('/office/brands', 'OfficesController@brands');
Route::get('/office/edit_brand/{brand_id}', 'OfficesController@edit_brand');
Route::post('/office/update_brands', 'OfficesController@update_brands');
Route::get('/office/new_brand', 'OfficesController@new_brand');
Route::post('/office/save_brand', 'OfficesController@save_brand');
Route::get('/office/suppliers', 'OfficesController@suppliers');
Route::post('/office/suppliers', 'OfficesController@suppliers');
Route::get('/office/edit_supplier/{brand_id}', 'OfficesController@edit_supplier');
Route::post('/office/update_supplier', 'OfficesController@update_supplier');
Route::get('/office/new_supplier', 'OfficesController@new_supplier');
Route::post('/office/save_supplier', 'OfficesController@save_supplier');
Route::get('/office/repairs', 'OfficesController@repairs');
Route::get('/office/submit_status', 'OfficesController@submit_status');
Route::get('/office/fetch_data_for_repair', 'OfficesController@fetch_data_for_repair');
Route::get('/office/others', 'OfficesController@others')->middleware('administrator');
Route::post('/office/save_position', 'OfficesController@save_position')->middleware('administrator');
Route::post('/office/save_unit', 'OfficesController@save_unit')->middleware('administrator');
Route::post('/office/save_receipt', 'OfficesController@save_receipt')->middleware('administrator');
Route::post('/office/save_category', 'OfficesController@save_category')->middleware('administrator');
Route::post('/office/save_location_type', 'OfficesController@save_location_type')->middleware('administrator');
Route::get('/office/deliveries', 'OfficesController@deliveries');
Route::get('/office/create_deliveries', 'OfficesController@create_deliveries');
Route::post('/office/delivery_request', 'OfficesController@delivery_request');
Route::get('/office/delivery_items/{transaction_id}', 'OfficesController@delivery_items');
Route::get('/office/delivery_product_data', 'OfficesController@delivery_product_data');
Route::get('/office/fetch_delivery_transactions', 'OfficesController@fetch_delivery_transactions');
Route::get('/office/generate_delivery_pdf/{transaction_id}', 'OfficesController@generate_delivery_pdf');
Route::get('/office/cancel_delivery_transaction/{transaction_id}', 'OfficesController@cancel_delivery_transaction');
Route::post('/office/cancel', 'OfficesController@cancel');
Route::get('/office/fetch_data_for_defect_return', 'OfficesController@fetch_data_for_defect_return');
Route::get('/office/fetch_data_for_reason', 'OfficesController@fetch_data_for_reason');
// --------------- End Office Route ---------------------->

// --------------- Store Route --------------------------->
Route::get('/store/dashboard', 'StoresController@index');
Route::get('/store/product', 'StoresController@product')->name('product_list');
Route::post('/store/product', 'StoresController@product');
Route::get('/store/get_product_list_data', 'StoresController@get_product_list_data');
Route::post('/store/is_product_exist', 'StoresController@is_product_exist');
Route::post('/store/add_inventory', 'StoresController@add_inventory');
Route::get('/store/new_inventory/{product_id}', 'StoresController@new_inventory');
Route::get('/store/add_new_inventory/{product_id}', 'StoresController@add_new_inventory');
Route::get('/store/inventory', 'StoresController@inventory')->name('inventory_list');
Route::post('/store/inventory', 'StoresController@inventory');
Route::get('/store/get_inventory_list_data', 'StoresController@get_inventory_list_data');
Route::post('/store/update_inventory', 'StoresController@update_inventory');
Route::get('/store/sales', 'StoresController@sales')->middleware('sales');
Route::post('/store/sales', 'StoresController@sales')->middleware('sales');
Route::get('/store/add_sales', 'StoresController@add_sales')->middleware('sales');
Route::post('/store/add_sales', 'StoresController@add_sales')->middleware('sales');
Route::post('/store/date', 'StoresController@date');
Route::post('/store/transact_sales', 'StoresController@transact_sales')->middleware('sales');
Route::post('/store/load_store_product', 'StoresController@load_store_product');
Route::post('/store/show_item_list', 'StoresController@show_item_list');
Route::get('/store/generate_sales_pdf/{transaction_date}', 'StoresController@generate_sales_pdf');
Route::get('/store/transfer', 'StoresController@transfer')->name('transfer_list');
Route::post('/store/transfer', 'StoresController@transfer');
Route::get('/store/create_transfer', 'StoresController@create_transfer');
Route::get('/store/fetch_data', 'StoresController@fetch_data');
Route::get('/store/fetch_data_for_transfer', 'StoresController@fetch_data_for_transfer');
Route::post('/store/transfer_request', 'StoresController@transfer_request');
Route::post('/store/show_pending_list', 'StoresController@show_pending_list');
Route::get('/store/recieve', 'StoresController@recieve')->name('stock_recieve');
Route::post('/store/recieve', 'StoresController@recieve');
Route::get('/store/recieve_stocks/{transaction_id}', 'StoresController@recieve_stocks');
Route::post('/store/recieved_items', 'StoresController@recieved_items');
Route::get('/store/generate_transfers_pdf/{transaction_id}', 'StoresController@generate_transfers_pdf');
Route::get('/store/transaction', 'StoresController@transaction')->name('transaction_list');
Route::post('/store/transaction', 'StoresController@transaction')->name('transaction_list');
Route::get('/store/fetch_data_for_rtransaction', 'StoresController@fetch_data_for_rtransaction');
Route::get('/store/transacted_items/{transaction_id}', 'StoresController@transacted_items');
Route::get('/store/generate_transaction_pdf/{transaction_id}', 'StoresController@generate_transaction_pdf');
Route::get('/store/sales_returns', 'StoresController@sales_returns')->middleware('sales');
Route::post('/store/chart_data', 'StoresController@chart_data');
Route::post('/store/show_item_returns', 'StoresController@show_item_returns');
Route::post('/store/transact_change_item', 'StoresController@transact_change_item');
Route::get('/store/cancel_transaction/{transaction_id}', 'StoresController@cancel_transaction')->middleware('full');
Route::post('/store/cancel', 'StoresController@cancel');
Route::get('/store/fetch_data_for_reason', 'StoresController@fetch_data_for_reason');
Route::get('/store/profile', 'StoresController@profile')->name('profile');;
Route::get('/store/profile_photo', 'StoresController@profile_photo');
Route::post('/store/upload_image', 'StoresController@upload_image');
Route::post('/store/save_image', 'StoresController@save_image');
Route::post('/store/save_username', 'StoresController@save_username');
Route::post('/store/save_password', 'StoresController@save_password');
Route::get('/store/user_info', 'StoresController@user_info');
Route::get('/store/repairs', 'StoresController@repairs')->middleware('sales');
Route::get('/store/add_manually', 'StoresController@add_manually')->middleware('sales');
Route::get('/store/fetch_data_for_products', 'StoresController@fetch_data_for_products')->middleware('sales');
Route::post('/store/save_repair', 'StoresController@save_repair')->middleware('sales');
Route::get('/store/edit_repair/{repair_id}', 'StoresController@edit_repair')->middleware('sales');
Route::post('/store/update_repair', 'StoresController@update_repair')->middleware('sales');
Route::get('/store/fetch_data_for_repair', 'StoresController@fetch_data_for_repair')->middleware('sales');
Route::get('/store/submit_status', 'StoresController@submit_status')->middleware('sales');
Route::get('/store/repack_inventory/{inventory_id}', 'StoresController@repack_inventory');
Route::post('/store/explode_inventory', 'StoresController@explode_inventory');
Route::get('/store/stocks_pdf/{brand_id}', 'StoresController@stocks_pdf');
Route::get('/store/recieve_delivery/{id}', 'StoresController@recieve_delivery');
Route::post('/store/from_office', 'StoresController@from_office');
Route::get('/store/generate_tags_pdf/{array}', 'StoresController@generate_tags_pdf');
// --------------- End Store Route ----------------------->
