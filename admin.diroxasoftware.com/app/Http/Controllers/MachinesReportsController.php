<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\StockPrice;
use App\StockCost;
use App\StockTotalQuantity;
use DB;
use App\productsgeneralbalance;
use App\lowquantity;
use App\costbenefit;
use App\worstcostbenefit;
use App\numbermachines;
use App\seeopenworks;
use App\NumberClosedServices;
use App\WorkOrderTotalAmount; 
use App\Machine;
use App\TotalnumberofProductsInMachines;
use App\machinesallinfos;
use App\customerandTheirmachines;
use App\totalincomewklabours;
use App\totalWithoutPartsCost;

class MachinesReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $allproducts = Product::paginate(10);

        // amoun in products
        $stockPrice = StockPrice::all()->first()->stockSellPrice;

        // amount spent in products
        $stockCost = StockCost::all()->first()->stockCostPrice;

        // Quantities products
        $StockTotalQuantity = StockTotalQuantity::all()->first()->TOTAL;
        
        $productsgeneralbalance = productsgeneralbalance::all()->first()->total;

        $allproductsLowQuantity = lowquantity::paginate(10);

        $allcostbenefit = costbenefit::paginate(3);

        $allworstcostbenefit = worstcostbenefit::paginate(3);
        
        $seeopenworks = seeopenworks::all();

        $NumberClosedServices = NumberClosedServices::all();
        
        $WorkOrderTotalAmount = WorkOrderTotalAmount::all();
        $WorkOrderTotalAmount2 = WorkOrderTotalAmount::all()->first()->totalWithVAT;

        $allmachines = machinesallinfos::all();
        
        $Nmachines = machinesallinfos::count();

        $NprodsInMachines = TotalnumberofProductsInMachines::all();

        $customerandTheirmachines = customerandTheirmachines::paginate(10);
        $customerandTheirmachines2 = customerandTheirmachines::all()->first();


        // added
        $totalincomewklabours = totalincomewklabours::all()->first()->totalwK;
        $totalincomewklabours = number_format($totalincomewklabours, 2, '.',',');
        
        $totalWithoutPartsCost = totalWithoutPartsCost::all()->first()->totalwithoutproducts;
        $totalWithoutPartsCost = number_format($totalWithoutPartsCost, 2, '.',',');

        



        return view('sections.reports.machines.index', compact('totalWithoutPartsCost', 'totalincomewklabours','allproducts', 'stockPrice', 'stockCost', 'StockTotalQuantity', 'productsgeneralbalance', 'allproductsLowQuantity', 'allcostbenefit', 'allworstcostbenefit', 'Nmachines', 'seeopenworks', 'NumberClosedServices', 'WorkOrderTotalAmount', 'allmachines', 'NprodsInMachines', 'customerandTheirmachines', 'WorkOrderTotalAmount2', 'customerandTheirmachines2'));
    }

}
// CREATE VIEW TotalnumberofProductsInMachines AS 
// SELECT SUM(pw.productQuantity)  as total, pw.workOrderReference, wk.id, wk.status
// from products_machines_workorders pw
// inner join work_order wk
// where pw.workOrderReference = wk.id 
// AND  wk.status = 1 ;