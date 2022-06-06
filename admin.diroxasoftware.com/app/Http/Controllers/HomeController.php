<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\productsAllinfos;
use App\Customer;
use App\WorkOrder;
use App\Machine;
use App\Appointment;
use App\Quote;
use App\QuoteStatus0;
use DB;
use App\lowquantity;
use App\salesReportsGroups;
use App\ProductbestSeller;
use App\totalearningstoday;
use App\machinesallinfos;

class HomeController extends Controller 
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function welcome()
     {


        $salesReportsGroups = salesReportsGroups::all()->first();
        $NumberOfSales = $salesReportsGroups->QuantitySales;

        $searchProd = Product::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nprod = $searchProd-> total;
        


        $searchWorkOrder = WorkOrder::select(DB::raw('COUNT(*) AS total'))
        ->where('status', '=', 0)
        ->first();
        $NworkOrder = $searchWorkOrder-> total;


        $findCollectionWorkOrder = WorkOrder::select(DB::raw('COUNT(*) AS total'))
        ->where('status', '=', 2)
        ->first();
        $Nwkwaitingforcollection = $findCollectionWorkOrder-> total;


        $searchQuote2 = Quote::select(DB::raw('COUNT(*) AS total '))
        ->first();
        $AllNquote = $searchQuote2-> total;

        $searchQuote = QuoteStatus0::select(DB::raw('COUNT(*) AS total '))
        ->first();
        $Nquote = $searchQuote-> total;


        $Nmachine = Machine::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nmachine = $Nmachine-> total;

        $Nproducts = Product::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nproducts = $Nproducts-> total;


        
        $searchCustomer = Customer::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Ncustomer = $searchCustomer-> total;
        
        // puxa dos products
        $productslowquantities = lowquantity::paginate(10);

        //  $ProductbestSeller = ProductbestSeller::all()->orderBy('totalQuantitySales');

        $ProductbestSeller = DB::table('ProductbestSeller')
                ->orderBy('totalQuantitySales', 'desc')
                ->first();

        $todayDate = date('Y/m/d');

        // return $allAppointment  =  DB::table('appointments')
        //     ->select(DB::raw('*'))
        //     ->whereBetween('appointmentDate', [$start, $end])
        //     ->get();

        
        $Nappointments = Appointment::select(DB::raw('COUNT(*) AS total'))
            ->where('appointmentDate', [$todayDate])
            ->first();
            $Nappointments = $Nappointments-> total;


        // total earningsToday
        $todayDate =  date('Y-m-d');
        $findearningstoday = totalearningstoday::where('created_at', 'LIKE', $todayDate)->first();

        if($findearningstoday == null){
            $totalearningstoday = 0;
        }
        else{
             $totalearningstoday = $findearningstoday->totaltoday;
        }

        $totearningstoday = number_format($totalearningstoday, 2, '.',',');


        $latestMachine = machinesallinfos::latest()->first();
        $allcustomers = Customer::all();
        $backRoute = "welcomePage";

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();
        $routeBack = "indexPage";


        return view('welcome', 
        compact('totearningstoday', 'ProductbestSeller','Nappointments', 'latestMachine', 'allcustomers', 'allmachines',
        'Nproducts', 'Nprod', 'NworkOrder', 'Nmachine', 'Ncustomer', 'Nquote', 'backRoute', 'allproducts',  'routeBack',
         'productslowquantities', 'AllNquote', 'NumberOfSales', 'ProductbestSeller', 
         'Nwkwaitingforcollection'));

     }

    public function index()
    {

        $searchProd = Product::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nprod = $searchProd-> total;
           
        $searchWorkOrder = WorkOrder::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $NworkOrder = $searchWorkOrder-> total;

        $Nmachine = Machine::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nmachine = $Nmachine-> total;

        $searchQuote = QuoteStatus0::select(DB::raw('COUNT(*) AS total '))
        ->first();
        $Nquote = $searchQuote-> total;
        
        $searchCustomer = Customer::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Ncustomer = $searchCustomer-> total;

        $ProductbestSeller = ProductbestSeller::all()->first();

        
       return view('welcome', compact('Nprod', 'Nquote','NworkOrder', 'Nmachine', 'Ncustomer', 'ProductbestSeller'));
    }

    public function testecombobox()
    {
        return view ('teste');
    }

    public function searchingCustomerAjax(Request $request){

        $dataSearchResult =  $request->data;
        $searchByOptions = $request->searchByOptions;

        if($searchByOptions == "customerName"){
            if($dataSearchResult == '' || $dataSearchResult == null){
                return $allcustomers = 0;
            }
            else{
                $allcustomers = Customer::where('name', 'LIKE', "%$dataSearchResult%")
                                        ->orWhere('email','LIKE', "%$dataSearchResult%")             
                                        ->orWhere('telephone','LIKE', "%$dataSearchResult%")             
                                        ->get();
                return $allcustomers;
            }
        }
        if($searchByOptions == "numberPlate"){
            if($dataSearchResult == '' || $dataSearchResult == null){
                return $allcustomers = 0;
            }
            else{
                $allcustomers = machinesallinfos::where('serial_number', 'LIKE', "%$dataSearchResult%")
                                        ->get();
                return $allcustomers;
            }
        }
    }


    public function searchingCustomerAjaxByBuySection(Request $request){

        $dataSearchResult =  $request->data;
        $searchByOptions = $request->searchByOptions;

            if($dataSearchResult == '' || $dataSearchResult == null){
                return $allcustomers = 0;
            }
            else{
                $allcustomers = Customer::where('name', 'LIKE', "%$dataSearchResult%")
                                        ->orWhere('email','LIKE', "%$dataSearchResult%")             
                                        ->orWhere('telephone','LIKE', "%$dataSearchResult%")             
                                        ->get();
                return $allcustomers;
            }
    }


    public function searchBikeByNumberPlate(Request $request){

        $dataSearchResult =  $request->data;
        $searchByOptions = $request->searchByOptions;

            if($dataSearchResult == '' || $dataSearchResult == null){
                $allcustomers = machinesallinfos::all();
                return $allcustomers;
            }
            else{
                $allcustomers = machinesallinfos::where('serial_number', 'LIKE', "%$dataSearchResult%")
                                        ->get();
                return $allcustomers;
            }
    }




    public function searchingProductsAjax(Request $request)
    {
        $dataSearchResult =  $request->data;
        // if($dataSearchResult == '' || $dataSearchResult == null){
        //     return $allproducts = 0;
        // }
        // else{
        //     $allproducts = productsallinfos::where('name', 'LIKE', "%$dataSearchResult%")
        //                             ->orWhere('categoryName','LIKE', "%$dataSearchResult%")             
        //                             ->orWhere('id','LIKE', "$dataSearchResult")
        //                             ->orWhere('SKU','LIKE', "%$dataSearchResult%")
        //                             ->orWhere('brand','LIKE', "%$dataSearchResult%")
        //                             ->orWhere('condition','LIKE', "$dataSearchResult")
        //                             ->get();
        //     return response()->json($allproducts);
        // }

        $allproducts = productsallinfos::where('name', 'LIKE', "%$dataSearchResult%")
                ->orWhere('categoryName','LIKE', "%$dataSearchResult%")             
                ->orWhere('id','LIKE', "$dataSearchResult")
                ->orWhere('SKU','LIKE', "%$dataSearchResult%")
                ->orWhere('brand','LIKE', "%$dataSearchResult%")
                ->orWhere('condition','LIKE', "$dataSearchResult")
                ->get();
        return response()->json($allproducts);

    }


    public function searchingProductsAjaxById(Request $request)
    {
        $dataSearchResult =  $request->data;
        if($dataSearchResult == '' || $dataSearchResult == null){
            return $allproducts = 0;
        }
        else{
            $allproducts = Product::where('id', '=', "$dataSearchResult")->first();
            return $allproducts;
        }
    }


    public function printertemplate()
    {

        return view('sections.printertemplate');
    }

    public function findCustomerInfos(Request $request)
    {
        $machineId = $request->data;

        $allmachinesinfos = machinesallinfos::find($machineId);
        return $allmachinesinfos;
    }
}
