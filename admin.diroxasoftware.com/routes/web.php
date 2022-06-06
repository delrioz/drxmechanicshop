<?php


// return "The montlhy payment wasn't made or wasn't recognized please contact DIROXA IT SOLUTIONS SUPPORT";


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

Route::get('/home', 'HomeController@welcome')->name('home');

Route::any('/home/searchingCustomerAjax', 'HomeController@searchingCustomerAjax')->name('home.searchingCustomerAjax');
Route::any('/home/searchingCustomerAjaxByBuySection', 'HomeController@searchingCustomerAjaxByBuySection')->name('home.searchingCustomerAjaxByBuySection');
Route::any('/home/searchingProductsAjax', 'HomeController@searchingProductsAjax')->name('home.searchingProductsAjax');
Route::any('/home/searchingProductsAjaxById', 'HomeController@searchingProductsAjaxById')->name('home.searchingProductsAjaxById');
Route::any('/home/searchBikeByNumberPlate', 'HomeController@searchBikeByNumberPlate')->name('home.searchBikeByNumberPlate');
Route::any('/home/findCustomerInfos', 'HomeController@findCustomerInfos')->name('home.findCustomerInfos');


Route::get('/teste', 'HomeController@testecombobox');

// Customers

Route::post('/section/costumers/createAjax', 'CustomersController@store')->name('customer.post');
Route::post('/section/costumers/createMachineAjax', 'CustomersController@createMachineAjax')->name('customer.machineajax');
Route::any('/section/costumers/searchCustomerAjax', 'CustomersController@searchCustomerAjax')->name('customer.searchCustomerAjax');
Route::any('/section/costumers/searchCustomerAjaxByFilters', 'CustomersController@searchCustomerAjaxByFilters')->name('customer.searchCustomerAjaxByFilters');


Route::post('/section/costumers/createAjaxandAddmachine', 'CustomersController@createAjaxandAddmachine')->name('grocery.post');

Route::get('/section/customers', 'CustomersController@index')->name('customer.index');
Route::get('/section/customers/create/{from?}', 'CustomersController@create')->name('customer.create');
Route::post('/section/customers/store', 'CustomersController@storeandnewmachine')->name('customer.store');
Route::any('/section/customers/createmachine', 'CustomersController@createmachine')->name('customer.createmachine');
Route::any('/section/customers/createmachineonviewpage/{id}', 'CustomersController@createmachineonviewpage')->name('customer.createmachineonviewpage');
Route::any('/section/customers/createmachine/store', 'CustomersController@createmachinestore')->name('customer.createmachinestore');

Route::get('/section/customers/viewPage/{id}', 'CustomersController@viewPage')->name('customer.viewPage');
Route::get('/section/customers/edit/{id}/{from?}/{idMachineFrom?}', 'CustomersController@edit')->name('customer.edit');
Route::post('/section/customers/update/{id}', 'CustomersController@update')->name('customer.update');
Route::get('/section/customers/destroy/{id}', 'CustomersController@destroy')->name('customer.destroy');

// abas que podemos acessar atraves da viewpage customers
Route::get('/section/customers/viewPage/allbikes/{id}', 'CustomersController@allbikescustomers')->name('customer.allbikescustomers');



// Categorie
Route::get('/section/categories', 'CategoriesController@index')->name('category.index');
Route::get('/section/categories/create', 'CategoriesController@create')->name('category.create');
Route::post('/section/categories/store', 'CategoriesController@store')->name('category.store');
Route::get('/section/categories/edit/{id}', 'CategoriesController@edit')->name('category.edit');
Route::post('/section/categories/update/{id}', 'CategoriesController@update')->name('category.update');
Route::get('/section/categories/destroy/{id}', 'CategoriesController@destroy')->name('category.destroy');
Route::get('/section/categories/view/{id}',  'CategoriesController@view')->name('category.view');
Route::post('/section/categories/storeAjax', 'CategoriesController@storeAjax')->name('category.storeAjax');



// Products
Route::get('/section/products', 'ProductsController@index')->name('product.index');
Route::get('/section/products/create/{from?}', 'ProductsController@create')->name('product.create');
Route::post('/section/products/store', 'ProductsController@store')->name('product.store');
Route::get('/section/products/edit/{id}/{from?}', 'ProductsController@edit')->name('product.edit');
Route::post('/section/products/update/{id}', 'ProductsController@update')->name('products.update');
Route::get('/section/products/destroy/{id}', 'ProductsController@destroy')->name('product.destroy');
Route::any('/section/products/buyingProducts', 'ProductsController@buyingProducts')->name('product.buying');
Route::any('/section/products/trolley', 'ProductsController@trolley')->name('product.trolley');
Route::any('/section/products/buyingProducts/Post', '@buyingProductsPost')->name('product.buying');
Route::any('/section/products/buyingProducts/ajaxCart/', 'ProductsController@ajaxCart')->name('product.ajaxCart');
Route::any('/section/products/buyingProducts/finishPayment', 'ProductsController@finishPayment')->name('product.finishPayment');
Route::any('/section/products/buyingProducts/confirmPayment', 'ProductsController@confirmPayment')->name('product.confirmPayment');
Route::get('/section/products/view/{id}/{from?}', 'ProductsController@view')->name('product.view');
Route::get('/section/products/forcustomers/view/{id}', 'ProductsController@forcustomersview')->name('product.forcustomersview');
Route::any('/section/products/buyingProducts/ajaxdr/{id}', 'ProductsController@ajaxdr')->name('product.ajaxdr');
Route::any('/section/products/takingdatas', 'ProductsController@takingdatas')->name('product.takingdatas');
Route::any('/section/products/getProdsAjax', 'ProductsController@getProdsAjax')->name('product.getProdsAjax');
Route::any('/section/products/getProdsAjax2', 'ProductsController@getProdsAjax2')->name('product.getProdsAjax2');

Route::any('/section/products/addProductsAjax', 'ProductsController@addProductsAjax')->name('product.addProductsAjax');


Route::any('/section/products/getProductsAjaxOnReportsPage', 'ProductsController@getProductsAjaxOnReportsPage')->name('product.getProductsAjaxOnReportsPage');


// Reports
    // Reports - Products
    Route::get('/section/reports/products', 'ProductsReportsController@index')->name('product.reports.index');
    Route::post('/section/reports/products/all', 'ProductsReportsController@all')->name('product.reports.all');
    Route::post('/section/reports/products/allbycategories', 'ProductsReportsController@allbycategories')->name('product.reports.allbycategories');
    Route::get('/section/reports/lowproducts', 'ProductsReportsController@allLowqtsProducts')->name('product.reports.allLowqtsProducts');


    // Reports - Machines
    // Route::get('/section/reports/machines', 'MachinesReportsController@index')->name('product.reports.index');


    // Reports - Sales
    Route::get('/section/reports/SalesReports', 'SalesReportsController@index')->name('sales.reports.index');
    Route::any('/section/reports/SalesReports/searchIt', 'SalesReportsController@searchIt')->name('sales.reports.searchIt');
    Route::any('/section/reports/SalesReports/salesreportsmonthly', 'SalesReportsController@salesreportsmonthly')->name('sales.reports.salesreportsmonthly');
    Route::post('/section/reports/SalesReports/searchajax', 'SalesReportsController@searchajax')->name('sales.searchajax');

    // Machines
    Route::get('/section/machines/{id?}/', 'MachinesController@index')->name('machine.index');
    Route::get('/section/machines/create/{from?}', 'MachinesController@create')->name('machine.create');
    Route::get('/section/machines/nocustomers/create', 'MachinesController@create')->name('machine.createNoCustomer');
    Route::post('/section/machines/store', 'MachinesController@store')->name('machine.store');
    Route::get('/section/machines/edit/{id}/{from?}', 'MachinesController@edit')->name('machine.edit');
    Route::post('/section/machines/update/{id}', 'MachinesController@update')->name('machine.update');
    Route::get('/section/machines/destroy/{id}/{from?}', 'MachinesController@destroy')->name('machine.destroy');
    Route::get('section/machines/view/{id}', 'MachinesController@view')->name('machine.view');
    Route::get('/section/machines/viewPage/{id}', 'MachinesController@viewPage')->name('machine.viewPage');
    Route::get('/section/machines/viewpage/viewinvoice/{id}', 'MachinesController@viewinvoice')->name('machine.viewinvoice');
    Route::any('/section/machines/machinesfilter', 'MachinesController@machinesfilter')->name('machine.machinesfilter');




    //sub view page
    Route::get('/section/machines/subviewpage/{id}/{destiny?}', 'MachinesController@subviewpage')->name('subviewpage.viewpages');

    // Internal Machines
    Route::get('/section/internalMachines', 'InternalMachinesController@index')->name('internalmachines.index');
    // Route::any('/section/internalMachines/createMachineAjax', 'InternalMachinesController@storeAjax')->name('internalmachines.storeAjax');
    Route::get('/section/internalMachines/create/{from?}', 'InternalMachinesController@create')->name('internalmachines.create');
    Route::any('/section/internalMachines/store', 'InternalMachinesController@store')->name('internalmachines.store');
    Route::get('/section/internalMachines/destroy/{id}', 'InternalMachinesController@destroy')->name('internalmachines.destroy');
    Route::get('/section/internalMachines/edit/{id}/{from?}', 'InternalMachinesController@edit')->name('internalmachines.edit');
    Route::post('/section/internalMachines/update/{id}', 'InternalMachinesController@update')->name('internalmachines.update');
    // Route::get('/section/internalMachines/view/{id}/{from?}', 'InternalMachinesController@view')->name('internalmachines.view');

    // Route::post('/section/costumers/createAjax', 'CustomersController@store')->name('customer.post');



    // Machines Repairs Reports
    Route::get('/section/reports/machines', 'MachinesRepairsController@index')->name('machines.reports.index');
    Route::any('/section/reports/machines/machinesrepairajax', 'MachinesRepairsController@machinesrepairreport')->name('machinesrepairreport.searchajax');




    // Sales
    Route::any('/section/sales/confirmPayment', 'SalesController@confirmPayment')->name('sales.confirmpayment');


Route::any('/printqio', 'PrintQioController@index');


// Quote

Route::get('/section/quote', 'QuoteController@index')->name('quote.index');
Route::get('/section/quote/create/{id?}', 'QuoteController@create')->name('quote.create');
Route::post('/section/quote/store', 'QuoteController@store')->name('quote.store');
Route::get('/section/quote/edit/{id}/{from?}/{updatingWarning?}', 'QuoteController@edit')->name('quote.edit');
Route::post('/section/quote/update/{id}', 'QuoteController@update')->name('quote.update');
Route::get('/section/quote/destroy/{id}', 'QuoteController@destroy')->name('quote.destroy');
Route::get('/section/quotesAlreadyDone/{id?}/{from?}', 'QuoteController@quotesAlreadyDone')->name('quote.qtsAlreadyDone');
Route::get('/section/quote/chooseQuantity', 'QuoteController@chooseQuantity')->name('quote.chooseQuantity');
Route::any('/section/quote/confirmQuantity', 'QuoteController@confirmQuantity')->name('quote.confirmQuantity');
Route::get('/section/quotesAlreadyDone/view/{id}', 'QuoteController@ViewquotesAlreadyDone')->name('quote.viewQtsAlreadyDone');
Route::get('/section/quote/previewInvoice/{id}/{from?}', 'QuoteController@previewInvoice')->name('quote.previewInvoice');
Route::any('/section/quote/createAjax', 'QuoteController@createAjax')->name('quote.createAjax');
Route::any('/section/quote/chooseQuantityAjax', 'QuoteController@chooseQuantityAjax')->name('quote.chooseQuantityAjax');
// Route::any('/section/quote/invoice', 'QuoteController@gerarinvoice')->name('qt.gerarinvoice');
Route::any('/section/quote/invoice/{data}', 'QuoteController@gerarinvoice')->name('qt.gerarinvoice');
Route::any('/section/quote/deleteinvoice/{id}/{quoteid}', 'QuoteController@deleteinvoice')->name('qt.deleteinvoice');
Route::any('/section/quote/checarInvoiceSemCadastrar', 'QuoteController@checarInvoiceSemCadastrar')->name('qt.checarInvoiceSemCadastrar');
Route::get('/section/quotesAlreadyDone/viewpage/viewinvoice/{id}', 'QuoteController@viewPreviewinvoice')->name('qt.viewpreviewinvoice');
Route::any('/section/quote/updateInvoiceAjax', 'QuoteController@updatePreviewQtAjax')->name('qt.updatePreviewQtAjax');

Route::any('/section/quote/searchQuoteAjax', 'QuoteController@searchQuoteAjax')->name('qt.searchQuoteAjax');

Route::any('/section/quote/getQuoteAjaxByMachine', 'QuoteController@getQuoteAjaxByMachine')->name('qt.getQuoteAjaxByMachine');
Route::any('/section/quote/getClosedQuoteByMachine', 'QuoteController@getClosedQuoteByMachine')->name('qt.getClosedQuoteByMachine');




// Work Order

// Route::any('/section/OpenWorkOrder/{id}', 'WorkOrderController@OpenWorkOrder')->name('workOrder.open');
Route::any('/section/OpenWorkOrder/', 'WorkOrderController@OpenWorkOrder')->name('workOrder.open');
Route::any('/section/OpenWorkOrderAjax/', 'WorkOrderController@OpenWorkOrderAjax');
Route::any('/RefuseQuotation', 'WorkOrderController@RefuseQuotation');


Route::get('/section/workOrder/index/{id?}', 'WorkOrderController@index')->name('workOrder.index');
Route::get('/section/workOrder/create/{id?}', 'WorkOrderController@create')->name('workOrder.create');
Route::post('/section/workOrder/store', 'WorkOrderController@store')->name('workOrder.store');
Route::get('/section/workOrder/edit/{id}/{from?}/{updatingWarning?}', 'WorkOrderController@edit')->name('workOrder.edit');
Route::post('/section/workOrder/update/{id}', 'WorkOrderController@update')->name('workOrder.update');
Route::get('/section/workOrder/destroy/{id}', 'WorkOrderController@destroy')->name('workOrder.destroy');
Route::any('/section/workOrder/saveandAddQnt', 'WorkOrderController@saveandAddQnt')->name('workOrder.saveandAddQnt');
Route::any('/section/workOrder/saveQuantities', 'WorkOrderController@saveQuantities')->name('workOrder.saveQuantities');
Route::any('/section/workOrder/allworkorder/{id?}/{from?}', 'WorkOrderController@allworkorder')->name('workOrder.allworkorder');
Route::any('/section/workOrder/chooseQuantity', 'WorkOrderController@chooseQuantity')->name('wk.chooseQuantity');
Route::any('/section/workOrder/confirmQuantity', 'WorkOrderController@confirmQuantity')->name('wk.confirmQuantity');
Route::any('/section/workOrder/checarInvoiceSemCadastrar', 'WorkOrderController@checarInvoiceSemCadastrar')->name('wk.checarInvoiceSemCadastrar');
Route::any('/section/workOrder/showinvoice/{id}', 'WorkOrderController@showinvoice')->name('wk.showinvoice');
Route::any('/section/workorder/updateInvoiceAjax', 'WorkOrderController@updateInvoiceAjax')->name('wk.updateInvoiceAjax');
Route::any('/section/workOrder/finishWK/{id}', 'WorkOrderController@finishWK')->name('wk.finishWK');
Route::post('/section/workorders/collected', 'WorkOrderController@markAsCollected')->name('wk.markAsCollected');




Route::any('/section/workorder/jobCart/{id}/{from?}', 'WorkOrderController@jobCart')->name('pays.jobCart');
Route::any('/section/workOrder/printJobCart', 'WorkOrderController@printjobCart')->name('wk.printjobCart');

Route::any('/section/workOrder/getWKAjaxByMachine', 'WorkOrderController@getWKAjaxByMachine')->name('wk.getWKAjaxByMachine');
Route::any('/section/workOrder/allworkorderAjaxByMachine', 'WorkOrderController@allworkorderAjaxByMachine')->name('wk.allworkorderAjaxByMachine');



// Payments
Route::any('/section/py/processing/{id}/{from?}', 'PaymentsController@processing')->name('pays.index');
Route::any('/section/py/confirmPayment', 'PaymentsController@confirmPayment')->name('pays.confirm');
Route::any('/section/py/confirmPaymentAjax', 'PaymentsController@confirmPaymentAjax')->name('pays.confirmAjax');
Route::any('/section/py/waitingforcollection', 'PaymentsController@waitingforcollection')->name('pays.waitingforcollection');
Route::any('/paymentscontroller/invoice/{id}', 'PaymentsController@gerarinvoice')->name('pays.gerarinvoice');
Route::get('/section/py/destroy/{id}', 'PaymentsController@destroy')->name('py.destroy');



Route::any('/NewPrinterInvoice', 'NewPrinterInvoice@print');


// Functions
Route::post('/function/dashboardPageSearch', 'FunctionsController@dashboardPageSearch')->name('dash.search');

// Carrito
Route::get('/section/carrito/index', 'CarritoController@index')->name('carrito.index');
Route::get('/section/carrito/processarcompra', 'CarritoController@processarCompra')->name('carrito.processarCompra');
Route::any('/section/carrito/generatingInvoice', 'CarritoController@generatingInvoice')->name('carrito.generatingInvoice');

route::any('/section/carrito/generatingInvoice2', 'CarritoController@generatingInvoiceAjax')->name('carrito.invoiceAjax');

Route::get('/section/carrito/invoice/{id}', 'CarritoController@invoice')->name('carrito.invoice');
Route::get('/section/carrito/customerReceipt/{id}', 'CarritoController@customersreceipt')->name('carrito.customersreceipt');
Route::get('/section/carrito/balance/{id?}/{from?}', 'CarritoController@balance')->name('carrito.balance');

Route::get('/section/buysection/index/{id?}', 'BuySectionController@index')->name('buysection.index');
Route::any('/section/buysection/finishingbuy', 'BuySectionController@finishingbuy')->name('buysection.finishingbuy');


///section/appointments

Route::get('/section/appointments/index/{id?}', 'AppointmentsController@index')->name('appointments.index');
Route::get('/section/appointments/create/', 'AppointmentsController@create')->name('appointments.create');
Route::post('/section/appointments/store', 'AppointmentsController@store')->name('appointments.store');
Route::get('/section/appointments/edit/{id?}/{from?}', 'AppointmentsController@edit')->name('appointments.edit');
Route::post('/section/appointments/update/{from?}', 'AppointmentsController@update')->name('appointments.update');
Route::get('/section/appointments/destroy/{id}', 'AppointmentsController@destroy')->name('appointments.destroy');
Route::get('/section/appointments/view/{id}/indexOutGoing/', 'AppointmentsController@view')->name('appointments.view');


Route::any('/section/appointments/appointmentsajax', 'AppointmentsController@appointmentsajax')->name('appointments.appointmentsajax');




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


//invoice controller

//Salesf

Route::get('/section/sales/allsales/{id?}', 'SalesController@allsales')->name('sales.allsales');
Route::any('/section/sales/allsales/searchajax', 'SalesController@searchajax')->name('salesallsales.searchajax');
Route::get('/section/sales/pendingSales', 'SalesController@pendingSales')->name('sales.pendingSales');
Route::get('/section/sales/allsales/invoice/{id}/{from}', 'SalesInvoiceController@index')->name('sales.allsales');
Route::get('/section/sales/allsales/delete/{id}', 'SalesInvoiceController@destroy')->name('sales.destroy');
Route::get('/section/sales/allsales/viewsales/{id?}', 'SalesController@viewsales')->name('sales.viewsales');
Route::post('/section/sales/makeApayment', 'SalesController@makeApayment')->name('sales.makeApayment');
Route::get('/section/sales/latepaymentsinvoices/{id}/{Npayments}/{from?}', 'SalesController@latepaymentsinvoices')->name('sales.latepaymentsinvoices');


// Route::get('/section/customersReceipt/index80mm','CustomersReceiptController@indexInvoice80mm')->name('customersReceipt.invoice80mm');
// Route::get('/section/carrito/customerReceipt/{id}', 'CarritoController@customersreceipt')->name('carrito.customersreceipt');
Route::get('/section/carrito/customerReceipt/{id}', 'CustomersReceiptController@indexInvoice80mm')->name('carrito.customersreceipt.invoice80mm');



// Hire Machine
Route::get('/section/hireamachine', 'HireaMachineController@index')->name('hiremachine.index');
Route::post('/section/hireamachine/customersforhiring/store', 'HireaMachineController@store')->name('hiremachine.storecustomer');
Route::get('/section/hireamachine/allmachines/{id?}', 'HireaMachineController@allmachines')->name('hiremachine.allmachines');
Route::get('/section/hireamachine/machinetohire/{id}', 'HireaMachineController@machinetohire')->name('hiremachine.machinetohire');
Route::post('/section/hireamachine/findCustomer', 'HireaMachineController@findCustomer')->name('hiremachine.findCustomer');
Route::post('/section/hireamachine/finalizingCustomerInfos/{id}', 'HireaMachineController@finalizingCustomerInfos')->name('hiremachine.finalizingCustomerInfos');
Route::post('/section/hireamachine/customersforhiring/storehiring', 'HireaMachineController@storehiring')->name('hiremachine.storehiring');
Route::post('/section/hireamachine/openthehiring', 'HireaMachineController@openthehiring')->name('hiremachine.openthehiring');
Route::get('/section/hireamachine/viacustomer/choosingmachine/{id}/{customerId?}', 'HireaMachineController@viacustomer')->name('hiremachine.viacustomer');
Route::get('/section/allhiremachiness/viewPage/{id}/{customerId?}/{status?}/{from?}', 'HireaMachineController@viewpage')->name('hiremachine.viewpage');
Route::get('/section/hiremachine/checkfirstinvoice/{id}', 'HireaMachineController@checkfirstinvoice')->name('hiremachine.checkfirstinvoice');
Route::post('/section/hiremachine/finishHiringGetPayment', 'HireaMachineController@finishHiringGetPayment')->name('hiremachine.finishHiringGetPayment');
Route::post('/section/hiremachine/editingAndGettingPayment', 'HireaMachineController@editingAndGettingPayment')->name('hiremachine.editingAndGettingPayment');
Route::get('/section/hiremachine/checklastinvoice/{id}', 'HireaMachineController@checklastinvoice')->name('hiremachine.checklastinvoice');
Route::get('/section/reports/machinehire', 'HireaMachineController@machinehire')->name('hiremachine.machinehire');
Route::get('/section/hiringMachine/reportsMachineHireviewPage/{hiremachineid?}/{machineId?}', 'HireaMachineController@reportsMachineHireviewPage')->name('hiremachine.reportsMachineHireviewPage');
Route::get('/section/allhiremachiness/edit/{id}/{customerId?}/{status?}/{from?}', 'HireaMachineController@edit')->name('hiremachine.edit');
Route::post('/section/allhiremachiness/update', 'HireaMachineController@update')->name('hiremachine.update');
Route::get('/section/allhiremachiness/destroy/{id}/{idOwner}', 'HireaMachineController@destroy')->name('hiremachine.destroy');
Route::post('/section/allhiremachiness/markascollected', 'HireaMachineController@markascollected')->name('hiremachine.markascollected');


// Excel Routes
Route::get('products/export/', 'ProductsController@export')->name('products.excel');
Route::get('salesreportscontroller/export/', 'SalesReportsController@export')->name('salesreportscontroller.excel');


// General Routes

Route::get('/section/reports/GeneralReports', 'GeneralReportsController@index')->name('generalReports.index');


//
Route::get('/section/reports/outgoing', 'OutgoingController@index')->name('outgoing.index');
Route::get('/section/outgoing/create/{id?}', 'OutgoingController@create')->name('outgoing.create');
Route::post('/section/outgoing/store', 'OutgoingController@store')->name('outgoing.store');
Route::get('/section/outgoing/edit/{id?}/{from?}', 'OutgoingController@edit')->name('outgoing.edit');
Route::post('/section/outgoing/update/{from?}', 'OutgoingController@update')->name('outgoing.update');
Route::get('/section/outgoing/destroy/{id}', 'OutgoingController@destroy')->name('outgoing.destroy');
Route::get('/section/outgoing/view/{id}/indexOutGoing/', 'OutgoingController@view')->name('outgoing.view');


// Suppliers

Route::get('/section/suppliers', 'SupplierController@index')->name('supplier.index');
Route::get('/section/suppliers/create', 'SupplierController@create')->name('supplier.create');
Route::post('/section/suppliers/store', 'SupplierController@store')->name('supplier.store');
Route::get('/section/suppliers/edit/{id?}/{from?}', 'SupplierController@edit')->name('supplier.edit');
Route::post('/section/suppliers/update', 'SupplierController@update')->name('supplier.update');
Route::get('/section/suppliers/view/{id}', 'SupplierController@view')->name('supplier.view');
Route::get('/section/suppliers/destroy/{id}', 'SupplierController@destroy')->name('supplier.destroy');


// All Invoices
Route::get('/section/allinvoices/index', 'AllInvoicesController@index')->name('allinvoices.index');
Route::any('/section/allinvoices/search', 'AllInvoicesController@search')->name('allinvoices.search');


//All Jobs
Route::get('/section/alljobs/index', 'AllJobsController@index')->name('alljobs.index');
