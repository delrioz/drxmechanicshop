<?php

namespace App\Http\Controllers;
use App\machinesallinfos;
use App\seeopenworks;
use App\NumberClosedServices;
use App\WorkOrderTotalAmount;
use App\customerandTheirmachines;
use App\TotalnumberofProductsInMachines;
use App\totalwkvalue;
use App\totaldiscountinwk;
use App\totalamountproducts;
use App\totalamoutwkwithoutprods;
use App\allworkorderinformations;
use App\totalvat;
use App\WorkOrder;
use DB;

use Illuminate\Http\Request;

class MachinesRepairsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $Nmachines = machinesallinfos::count();
        $seeopenworks = seeopenworks::all();
        $NumberClosedServices = NumberClosedServices::all();
        $WorkOrderTotalAmount2 = WorkOrderTotalAmount::all()->first()->totalWithVAT;
        $WorkOrderTotalAmount = WorkOrderTotalAmount::all();

        $allmachines = allworkorderinformations::all();

        $NprodsInMachines = TotalnumberofProductsInMachines::all();

        $totalwkvalue = totalwkvalue::all()->first()->totalWk;
        $totaldiscountinwk = totaldiscountinwk::all()->first()->totaldiscount;
        $totalamountproducts = totalamountproducts::all()->first()->totalamountProducts;
        $totalamoutwkwithoutprods = totalamoutwkwithoutprods::all()->first()->totalamoutwkwithoutprods;

        $totalvat = totalvat::all()->first()->totalvat;

        // use App\totalwkvalue;
        // use App\totaldiscountinwk;
    

        $customerandTheirmachines = customerandTheirmachines::paginate(10);
        $customerandTheirmachines2 = customerandTheirmachines::all()->first();
        $WkTotalWithVat = number_format($WorkOrderTotalAmount2, 2, '.',',');
        $totalwkvalue = number_format($totalwkvalue, 2, '.',',');
        $totaldiscountinwk = number_format($totaldiscountinwk, 2, '.',',');
        $totalamountproducts = number_format($totalamountproducts, 2, '.',',');
        $totalamoutwkwithoutprods = number_format($totalamoutwkwithoutprods, 2, '.',',');
        $totalvat = number_format($totalvat, 2, '.',',');

        // return 1;
        return view('sections.reports.machines.index', compact('Nmachines', 'seeopenworks', 'NumberClosedServices', 'WorkOrderTotalAmount', 'WorkOrderTotalAmount2', 'allmachines', 'customerandTheirmachines', 'customerandTheirmachines2', 'NprodsInMachines', 'WkTotalWithVat', 'totalwkvalue', 'totaldiscountinwk', 'totalamountproducts', 'totalamoutwkwithoutprods', 'totalvat'));
    }


    public function machinesrepairreport(Request $request)
    {


        $dataComecoPadraoDateTime = $request->dataComecoPadraoDateTime;
        $dataFimPadraoDateTime = $request->dataFimPadraoDateTime;


        $start =  $request->dataComecoPadraoDateTime;
        $end = $request->dataFimPadraoDateTime;

        // Sao valores fixos        
        $Nmachines = machinesallinfos::count();
        $seeopenworks = seeopenworks::all()->first()->TOTAL;
        $NumberClosedServices = NumberClosedServices::all()->first()->TOTAL;



        // general balance value
        $FilterCustomersMachines =  DB::table('allworkorderinformations')
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->get();
        $VarFilterCustomersMachines = $FilterCustomersMachines;



        // general balance value
        $WorkOrderTotalAmountFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(totalWithVAT + 0 ) AS totalWithVAT'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $WorkOrderTotalAmount = $WorkOrderTotalAmountFind->totalWithVAT;


        // general balance value
        $WorkOrderPerRange =  DB::table('work_order')
        ->select(DB::raw('COUNT(*) AS totalwkthisrange'))
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->first();
        $WorkOrderPerRangeDate = $WorkOrderPerRange->totalwkthisrange;


        // general balance value
        $ClosedWorkOrderPerRange =  DB::table('work_order')
        ->select(DB::raw('COUNT(*) AS totalclosedwkthisrange'))
        ->where('status', 1)
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->first();
        $ClosedWorkOrderPerRangeDate = $ClosedWorkOrderPerRange->totalclosedwkthisrange;

        
        // general balance value
        $OpenedWorkOrderPerRangeDate =  DB::table('work_order')
        ->select(DB::raw('COUNT(*) AS totalopenedwkthisrange'))
        ->where('status', 0)
        ->whereDate('created_at', '>=', $start)
        ->whereDate('created_at', '<=', $end)
        ->first();
        $OpenedWorkOrderPerRangeDate = $OpenedWorkOrderPerRangeDate->totalopenedwkthisrange;
        
        
        
        // $WorkOrderTotalAmount = WorkOrderTotalAmount::whereBetween('created_at', [$start, $end])->where('status', 'LIKE', '1')->count();
        // $totalwkvalue = DB::select('SELECT SUM(worklabor + 0 ) AS totalWk FROM workorder_payments WHERE created_at BETWEEN ? and ?', [$start, $end])[0];
        $totalwkvalueFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(worklabor + 0 ) AS totalWk'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $totalwkvalue = $totalwkvalueFind->totalWk;
        
        
        // $totaldiscountinwk = DB::select('SELECT SUM(discount + 0 ) AS totaldiscount  FROM workorder_payments WHERE created_at BETWEEN ? and ?', [$start, $end])[0];
        $totaldiscountinwkFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(discount + 0 ) AS totaldiscount'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $totaldiscountinwk = $totaldiscountinwkFind->totaldiscount;
        
        // $totalamountproducts = DB::select('SELECT SUM(amountProducts + 0 ) AS totalProdAmount FROM workorder_payments WHERE created_at BETWEEN ? and ?', [$start, $end])[0];
        $totalamountproductsFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(amountProducts + 0 ) AS totalProdAmount'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $totalamountproducts = $totalamountproductsFind->totalProdAmount;
        
        // $totalamoutwkwithoutprods = DB::select('SELECT SUM(amoutwkwithoutprods + 0 ) AS totalamoutwkwithoutprods FROM workorder_payments WHERE created_at BETWEEN ? and ?', [$start, $end])[0];
        $totalamoutwkwithoutprodsFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(amoutwkwithoutprods + 0 ) AS totalamoutwkwithoutprods'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $totalamoutwkwithoutprods = $totalamoutwkwithoutprodsFind->totalamoutwkwithoutprods;
        
        // $totalvat = DB::select('SELECT SUM(vat + 0 ) AS totalvat FROM workorder_payments WHERE created_at BETWEEN ? and ?', [$start, $end])[0];
        $totalvatprodsFind =  DB::table('workoderwithpayments')
        ->select(DB::raw('SUM(vat + 0 ) AS totalvat'))
        ->whereDate('WorkOrderCreatedDate', '>=', $start)
        ->whereDate('WorkOrderCreatedDate', '<=', $end)
        ->first();
        $totalvat = $totalvatprodsFind->totalvat;


        
        $WorkOrderTotalAmount = number_format($WorkOrderTotalAmount, 2, '.',',');
        $totalwkvalue = number_format($totalwkvalue, 2, '.',',');
        $totaldiscountinwk = number_format($totaldiscountinwk, 2, '.',','); 
        $totalamountproducts = number_format($totalamountproducts, 2, '.',','); 
        $totalamoutwkwithoutprods = number_format($totalamoutwkwithoutprods, 2, '.',','); 
        $totalvat = number_format($totalvat, 2, '.',','); 
        
        
        
        $Nmachines == null ? $Nmachines =  '0' : $Nmachines;
        $seeopenworks == null ? $seeopenworks =  '0' : $seeopenworks;
        $NumberClosedServices == null ? $NumberClosedServices =  '0' : $NumberClosedServices;
        $WorkOrderTotalAmount == null ? $WorkOrderTotalAmount =  '0.00' : $WorkOrderTotalAmount;
        $totalwkvalue == null ? $totalwkvalue =  '0.00' : $totalwkvalue;
        $totaldiscountinwk == null ? $totaldiscountinwk =  '0.00' : $totaldiscountinwk;
        $totalamountproducts == null ? $totalamountproducts =  '0.00' : $totalamountproducts;
        $totalamoutwkwithoutprods == null ? $totalamoutwkwithoutprods =  '0.00' : $totalamoutwkwithoutprods;
        $totalvat == null ? $totalvat =  '0.00' : $totalvat;

        $start = date('d/m/Y', strtotime($start));
        $end = date('d/m/Y', strtotime($end));


      
        // return $datasFound = [
        //     'Nmachines' => $Nmachines,
        //     'seeopenworks' => $seeopenworks,
        // ];


        return $datasFound = ['Nmachines' => $Nmachines,
        'seeopenworks' => $seeopenworks,
        'NumberClosedServices' => $NumberClosedServices,
        'WorkOrderTotalAmount' => $WorkOrderTotalAmount,
        'totalwkvalue' => $totalwkvalue,
        'totaldiscountinwk' => $totaldiscountinwk, 
        'totalamountproducts' => $totalamountproducts,
        'totalamoutwkwithoutprods' => $totalamoutwkwithoutprods,
        'totalvat' => $totalvat,
        'WorkOrderPerRangeDate' => $WorkOrderPerRangeDate,
        'ClosedWorkOrderPerRangeDate' => $ClosedWorkOrderPerRangeDate,
        'OpenedWorkOrderPerRangeDate' => $OpenedWorkOrderPerRangeDate,
        'start' => $start,
        'end' => $end,
        'VarFilterCustomersMachines' => $VarFilterCustomersMachines,
        ];

        $AmountSalesCashWithVAT = $reports_sales_cash->AmountSalesCashWithVAT; 
        $AmountSalesCashWithoutVAT = $reports_sales_cash->AmountSalesCashWithoutVAT; 
        $AmountSalesCashVAT = $reports_sales_cash->AmountSalesCashVAT; 
        $AmountSalesCashDiscount = $reports_sales_cash->AmountSalesCashDiscount; 
        $qtdSellByCash = $reports_sales_cash->NumberOfSalesCash;

    }

}
