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


Route::get('/', 'HomeController@welcome')->name('welcome');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/teste', 'HomeController@testecombobox');

// Customers

Route::get('/section/customers', 'CustomersController@index')->name('customer.index');
Route::get('/section/customers/create', 'CustomersController@create')->name('customer.create');
Route::post('/section/customers/store', 'CustomersController@store')->name('customer.store');
Route::get('/section/customers/edit/{id}', 'CustomersController@edit')->name('customer.edit');
Route::post('/section/customers/update/{id}', 'CustomersController@update')->name('customer.update');
Route::get('/section/customers/destroy/{id}', 'CustomersController@destroy')->name('customer.destroy');

// Categorie

Route::get('/section/categories', 'CategoriesController@index')->name('category.index');
Route::get('/section/categories/create', 'CategoriesController@index')->name('category.index');


// Products

Route::get('/section/products', 'ProductsController@index')->name('product.index');
Route::get('/section/products/create', 'ProductsController@create')->name('product.create');
Route::post('/section/products/store', 'ProductsController@store')->name('product.store');
Route::get('/section/products/edit/{id}', 'ProductsController@edit')->name('product.edit');
Route::post('/section/products/update/{id}', 'ProductsController@update')->name('products.update');
Route::get('/section/products/destroy/{id}', 'ProductsController@destroy')->name('product.destroy');
Route::any('/section/products/buyingProducts', 'ProductsController@buyingProducts')->name('product.buying');
Route::any('/section/products/trolley', 'ProductsController@trolley')->name('product.trolley');
Route::any('/section/products/buyingProducts/Post', 'ProductsController@buyingProductsPost')->name('product.buying');

// Reports 
Route::get('/section/reports/products', 'ProductsReportsController@index')->name('product.reports.index');


// Machines

Route::get('/section/machines', 'MachinesController@index')->name('machine.index');
Route::get('/section/machines/create', 'MachinesController@create')->name('machine.create');
Route::post('/section/machines/store', 'MachinesController@store')->name('machine.store');
Route::get('/section/machines/edit/{id}', 'MachinesController@edit')->name('machine.edit');
Route::post('/section/machines/update/{id}', 'MachinesController@update')->name('machine.update');
Route::get('/section/machines/destroy/{id}', 'MachinesController@destroy')->name('machine.destroy');





// Quote

Route::get('/section/quote', 'QuoteController@index')->name('quote.index');
Route::get('/section/quote/create', 'QuoteController@create')->name('quote.create');
Route::post('/section/quote/store', 'QuoteController@store')->name('quote.store');
Route::get('/section/quote/edit/{id}', 'QuoteController@edit')->name('quote.edit');
Route::post('/section/quote/update/{id}', 'QuoteController@update')->name('quote.update');
Route::get('/section/quote/destroy/{id}', 'QuoteController@destroy')->name('quote.destroy');
Route::get('/section/quotesAlreadyDone', 'QuoteController@quotesAlreadyDone')->name('quote.qtsAlreadyDone');
Route::get('/section/quotesAlreadyDone/view/{id}', 'QuoteController@ViewquotesAlreadyDone')->name('quote.viewQtsAlreadyDone');



// Work Order

Route::any('/section/OpenWorkOrder/{id}', 'WorkOrderController@OpenWorkOrder')->name('workOrder.open');
Route::get('/section/workOrder', 'WorkOrderController@index')->name('workOrder.index');
Route::get('/section/workOrder/create', 'WorkOrderController@create')->name('workOrder.create');
Route::post('/section/workOrder/store', 'WorkOrderController@store')->name('workOrder.store');
Route::get('/section/workOrder/edit/{id}', 'WorkOrderController@edit')->name('workOrder.edit');
Route::post('/section/workOrder/update/{id}', 'WorkOrderController@update')->name('workOrder.update');
Route::get('/section/workOrder/destroy/{id}', 'WorkOrderController@destroy')->name('workOrder.destroy');


// Payments
Route::any('/section/py/processing/{id}', 'PaymentsController@processing')->name('pays.index');
Route::any('/section/py/confirmPayment', 'PaymentsController@confirmPayment')->name('pays.confirm');



// Functions
Route::post('/function/dashboardPageSearch', 'FunctionsController@dashboardPageSearch')->name('dash.search');