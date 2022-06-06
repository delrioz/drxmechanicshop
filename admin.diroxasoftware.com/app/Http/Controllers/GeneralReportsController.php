<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\salesReportsGroups;
use App\WorkOrderTotalAmount;
use App\AmountExpenses;

class GeneralReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {   
        
        $salesReportsGroups = salesReportsGroups::all()->first();
        $totalProductSalesEarnings = $salesReportsGroups->total;
        $NumberOfSales = $salesReportsGroups->QuantitySales;

        
        $WorkOrderTotalAmount2 = WorkOrderTotalAmount::all()->first()->totalWithVAT;

        $AmountExpenses =  AmountExpenses::all()[0];
        $amountExpenses = $AmountExpenses->total;

        $generalTotalBalance =  ($totalProductSalesEarnings + $WorkOrderTotalAmount2) - $amountExpenses;

        $totalEarned = $totalProductSalesEarnings + $WorkOrderTotalAmount2;
         

        $totalgeneralbalance =   $totalEarned - $amountExpenses;

        $totalgeneralbalance = number_format($totalgeneralbalance, 2, '.',',');
        $generalTotalBalance = number_format($generalTotalBalance, 2, '.',',');
        $WkTotalWithVat = number_format($WorkOrderTotalAmount2, 2, '.',',');
        $totalProductSalesEarnings = number_format($totalProductSalesEarnings, 2, '.',',');
        $amountExpenses = number_format($amountExpenses, 2, '.',',');
        $totalEarned = number_format($totalEarned, 2, '.',',');


        return view('sections.reports.general.index',
         compact('totalgeneralbalance', 'totalEarned', 'salesReportsGroups', 'totalProductSalesEarnings', 'NumberOfSales', 'WorkOrderTotalAmount2', 
         'generalTotalBalance',
        'WkTotalWithVat', 'totalProductSalesEarnings', 'amountExpenses'));
    }
}
