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

Route::post('/section/costumers/createAjax', 'CustomersController@store')->name('customer.post');
Route::post('/section/costumers/createMachineAjax', 'CustomersController@createMachineAjax')->name('customer.machineajax');


Route::post('/section/costumers/createAjaxandAddmachine', 'CustomersController@createAjaxandAddmachine')->name('grocery.post');

Route::get('/section/customers', 'CustomersController@index')->name('customer.index');
Route::get('/section/customers/create', 'CustomersController@create')->name('customer.create');
Route::post('/section/customers/store', 'CustomersController@storeandnewmachine')->name('customer.store');
Route::any('/section/customers/createmachine', 'CustomersController@createmachine')->name('customer.createmachine');
Route::any('/section/customers/createmachineonviewpage/{id}', 'CustomersController@createmachineonviewpage')->name('customer.createmachineonviewpage');
Route::any('/section/customers/createmachine/store', 'CustomersController@createmachinestore')->name('customer.createmachinestore');

Route::get('/section/customers/viewPage/{id}', 'CustomersController@viewPage')->name('customer.viewPage');
Route::get('/section/customers/edit/{id}', 'CustomersController@edit')->name('customer.edit');
Route::post('/section/customers/update/{id}', 'CustomersController@update')->name('customer.update');
Route::get('/section/customers/destroy/{id}', 'CustomersController@destroy')->name('customer.destroy');

// Categorie

Route::get('/section/categories', 'CategoriesController@index')->name('category.index');
Route::get('/section/categories/create', 'CategoriesController@create')->name('category.create');
Route::post('/section/categories/store', 'CategoriesController@store')->name('category.store');
Route::get('/section/categories/edit/{id}', 'CategoriesController@edit')->name('category.edit');
Route::post('/section/categories/update/{id}', 'CategoriesController@update')->name('category.update');
Route::get('/section/categories/destroy/{id}', 'CategoriesController@destroy')->name('category.destroy');
Route::get('/section/categories/view/{id}',  'CategoriesController@view')->name('category.view');

// Products

Route::get('/section/products', 'ProductsController@index')->name('product.index');
Route::get('/section/products/create', 'ProductsController@create')->name('product.create');
Route::post('/section/products/store', 'ProductsController@store')->name('product.store');
Route::get('/section/products/edit/{id}', 'ProductsController@edit')->name('product.edit');
Route::post('/section/products/update/{id}', 'ProductsController@update')->name('products.update');
Route::get('/section/products/destroy/{id}', 'ProductsController@destroy')->name('product.destroy');
Route::any('/section/products/buyingProducts', 'ProductsController@buyingProducts')->name('product.buying');
Route::any('/section/products/trolley', 'ProductsController@trolley')->name('product.trolley');
Route::any('/section/products/buyingProducts/Post', '
@buyingProductsPost')->name('product.buying');
Route::any('/section/products/buyingProducts/ajaxCart/', 'ProductsController@ajaxCart')->name('product.ajaxCart');
Route::any('/section/products/buyingProducts/finishPayment', 'ProductsController@finishPayment')->name('product.finishPayment');
Route::any('/section/products/buyingProducts/confirmPayment', 'ProductsController@confirmPayment')->name('product.confirmPayment');
Route::get('/section/products/view/{id}', 'ProductsController@view')->name('product.view');
Route::any('/section/products/buyingProducts/ajaxdr/{id}', 'ProductsController@ajaxdr')->name('product.ajaxdr');
Route::any('/section/products/takingdatas', 'ProductsController@takingdatas')->name('product.takingdatas');

// Reports
    // Reports - Products
    Route::get('/section/reports/products', 'ProductsReportsController@index')->name('product.reports.index');
    Route::post('/section/reports/products/all', 'ProductsReportsController@all')->name('product.reports.all');
    Route::post('/section/reports/products/allbycategories', 'ProductsReportsController@allbycategories')->name('product.reports.allbycategories');
    Route::get('/section/reports/lowproducts', 'ProductsReportsController@allLowqtsProducts')->name('product.reports.allLowqtsProducts');
    

    // Reports - Machines
    Route::get('/section/reports/machines', 'MachinesReportsController@index')->name('product.reports.index');
    // Reports - Sales
    Route::get('/section/reports/SalesReports', 'SalesReportsController@index')->name('sales.reports.index');
    Route::any('/section/reports/SalesReports/searchIt', 'SalesReportsController@searchIt')->name('sales.reports.searchIt');
    Route::any('/section/reports/SalesReports/salesreportsmonthly', 'SalesReportsController@salesreportsmonthly')->name('sales.reports.salesreportsmonthly');

// Machines

Route::get('/section/machines', 'MachinesController@index')->name('machine.index');
Route::get('/section/machines/create', 'MachinesController@create')->name('machine.create');
Route::post('/section/machines/store', 'MachinesController@store')->name('machine.store');
Route::get('/section/machines/edit/{id}', 'MachinesController@edit')->name('machine.edit');
Route::post('/section/machines/update/{id}', 'MachinesController@update')->name('machine.update');
Route::get('/section/machines/destroy/{id}', 'MachinesController@destroy')->name('machine.destroy');
Route::get('section/machines/view/{id}', 'MachinesController@view')->name('machine.view');
Route::get('/section/machines/viewPage/{id}', 'MachinesController@viewPage')->name('machine.viewPage');

// Internal Machines

Route::get('/section/internalMachines', 'InternalMachinesController@index')->name('internalmachines.index');
// Route::any('/section/internalMachines/createMachineAjax', 'InternalMachinesController@storeAjax')->name('internalmachines.storeAjax');
Route::get('/section/internalMachines/create', 'InternalMachinesController@create')->name('internalmachines.create');
Route::any('/section/internalMachines/store', 'InternalMachinesController@store')->name('internalmachines.store');
Route::get('/section/internalMachines/destroy/{id}', 'InternalMachinesController@destroy')->name('internalmachines.destroy');
Route::get('/section/internalMachines/edit/{id}', 'InternalMachinesController@edit')->name('internalmachines.edit');
Route::post('/section/internalMachines/update/{id}', 'InternalMachinesController@update')->name('internalmachines.update');
Route::get('/section/internalMachines/view/{id}', 'InternalMachinesController@view')->name('internalmachines.view');


// Route::post('/section/costumers/createAjax', 'CustomersController@store')->name('customer.post');



// Sales 
Route::any('/section/sales/confirmPayment', 'SalesController@confirmPayment')->name('sales.confirmpayment');




// Quote

Route::get('/section/quote', 'QuoteController@index')->name('quote.index');
Route::get('/section/quote/create', 'QuoteController@create')->name('quote.create');
Route::post('/section/quote/store', 'QuoteController@store')->name('quote.store');
Route::get('/section/quote/edit/{id}', 'QuoteController@edit')->name('quote.edit');
Route::post('/section/quote/update/{id}', 'QuoteController@update')->name('quote.update');
Route::get('/section/quote/destroy/{id}', 'QuoteController@destroy')->name('quote.destroy');
Route::get('/section/quotesAlreadyDone', 'QuoteController@quotesAlreadyDone')->name('quote.qtsAlreadyDone');
Route::get('/section/quote/chooseQuantity', 'QuoteController@chooseQuantity')->name('quote.chooseQuantity');
Route::any('/section/quote/confirmQuantity', 'QuoteController@confirmQuantity')->name('quote.confirmQuantity');
Route::get('/section/quotesAlreadyDone/view/{id}', 'QuoteController@ViewquotesAlreadyDone')->name('quote.viewQtsAlreadyDone');


// Work Order

Route::any('/section/OpenWorkOrder/{id}', 'WorkOrderController@OpenWorkOrder')->name('workOrder.open');
Route::get('/section/workOrder', 'WorkOrderController@index')->name('workOrder.index');
Route::get('/section/workOrder/create', 'WorkOrderController@create')->name('workOrder.create');
Route::post('/section/workOrder/store', 'WorkOrderController@store')->name('workOrder.store');
Route::get('/section/workOrder/edit/{id}', 'WorkOrderController@edit')->name('workOrder.edit');
Route::post('/section/workOrder/update/{id}', 'WorkOrderController@update')->name('workOrder.update');
Route::get('/section/workOrder/destroy/{id}', 'WorkOrderController@destroy')->name('workOrder.destroy');
Route::any('/section/workOrder/saveandAddQnt', 'WorkOrderController@saveandAddQnt')->name('workOrder.saveandAddQnt');
Route::any('/section/workOrder/saveQuantities', 'WorkOrderController@saveQuantities')->name('workOrder.saveQuantities');


// Payments
Route::any('/section/py/processing/{id}', 'PaymentsController@processing')->name('pays.index');
Route::any('/section/py/confirmPayment', 'PaymentsController@confirmPayment')->name('pays.confirm');
Route::any('/paymentscontroller/invoice', 'PaymentsController@gerarinvoice')->name('pays.gerarinvoice');



// Functions
Route::post('/function/dashboardPageSearch', 'FunctionsController@dashboardPageSearch')->name('dash.search');

// Carrito
Route::get('/section/carrito/index', 'CarritoController@index')->name('carrito.index');
Route::get('/section/carrito/processarcompra', 'CarritoController@processarCompra')->name('carrito.processarCompra');
Route::any('/section/carrito/generatingInvoice', 'CarritoController@generatingInvoice')->name('carrito.generatingInvoice');

route::any('/section/carrito/generatingInvoice2', 'CarritoController@generatingInvoiceAjax')->name('carrito.invoiceAjax');

Route::get('/section/carrito/invoice/{id}', 'CarritoController@invoice')->name('carrito.invoice');

Route::get('/giovaniebrabo', 'gioebrabo@index');

// Searches
    // All Searches
route::any('/section/searches/index', 'Searches\AllSearchesController@index')->name('AllSearches.index');

    //Products
    route::get('/section/searches/products/', 'Searches\ProdsSearchesController@index')->name('products.index');
    route::get('/section/searches/products/edit/{id}', 'Searches\ProdsSearchesController@edit')->name('Prodsearches.edit');
    route::any('/section/searches/products/searches', 'Searches\ProdsSearchesController@search')->name('products.search');

    // Machines
    route::get('/section/searches/machines/', 'Searches\MachinesSearchesController@index')->name('machines.index');
    route::get('/section/searches/machines/edit/{id}', 'Searches\MachinesSearchesController@edit')->name('MachinesSearches.edit');
    route::any('/section/searches/machines/searches', 'Searches\MachinesSearchesController@search')->name('machines.search');
    route::any('/section/searches/machines/searches', 'Searches\MachinesSearchesController@Ajaxsearch')->name('machines.Ajaxsearch');

    // General
    route::any('/section/searches/general', 'Searches\GeneralSearchesController@search')->name('general.search');

    // Products in machines
    Route::get('/section/searches/productsinmachines', 'Searches\ProductsInMachines@index')->name('productsinmachines.index');
    Route::any('/section/searches/productsinmachines/search', 'Searches\ProductsInMachines@search')->name('productsinmachines.search');
    Route::any('/section/searches/productsinmachines/searchIndex/{id}', 'Searches\ProductsInMachines@searchIndex')->name('productsinmachines.searchIndex');

    // Machines in proucts
    Route::get('/section/searches/machinesinproducts', 'Searches\MachinesInProductsController@index')->name('machinesinproducts.index');
    Route::any('/section/searches/machinesinproducts/search', 'Searches\MachinesInProductsController@search')->name('machinesinproducts.search');
    Route::any('/section/searches/machinesinproducts/searchIndex/{id}', 'Searches\MachinesInProductsController@searchIndex')->name('machinesinproducts.searchIndex');




Route::get('invoice', function(){
    return view('invoice');
});

Route::resource('daterange', 'DateRangeController');


Route::get('/section/sales/extrasales', 'SalesController@ExtraSales')->name('sales.extrasales');
Route::post('/section/extrasales/store', 'SalesController@storeExtraSales')->name('sales.storeExtraSales');
