<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\salesReportsGroups;
use App\salesbycard;
use App\salesbycash;
use App\salesreportsmonthly;
use App\salesreportsgroupsByDataRange;
use DB;


class SalesReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   

        // return   $salesreportsmonthly = salesreportsmonthly::orderBy('totalSalesAmount', 'DESC')->get();

        $salesReportsGroups = salesReportsGroups::all()->first();
        $totalEarnings = $salesReportsGroups->total;
        $NumberOfSales = $salesReportsGroups->QuantitySales;
        $AVGtotalEarnings = $salesReportsGroups->AVGtotalAmount;
        $totalVAT = $salesReportsGroups->totalVAT;
        $totalDiscount = $salesReportsGroups->totalDiscount;
        
        // info sales by card
        $reports_sales_card = salesbycard::all()->first();
        $AmountSalesWithVAT = $reports_sales_card->AmountSalesWithVAT; 
        $AmountSalesWithoutVAT = $reports_sales_card->AmountSalesWithoutVAT; 
        $AmountSalesCardVAT = $reports_sales_card->AmountSalesCardVAT; 
        $AmountSalesCardDiscount = $reports_sales_card->AmountSalesCardDiscount; 
        $qtdSellByCard = $reports_sales_card->NumberOfSales;

        // info sales by cash
        $reports_sales_cash = salesbycash::all()->first();
        $AmountSalesCashWithVAT = $reports_sales_cash->AmountSalesCashWithVAT; 
        $AmountSalesCashWithoutVAT = $reports_sales_cash->AmountSalesCashWithoutVAT; 
        $AmountSalesCashVAT = $reports_sales_cash->AmountSalesCashVAT; 
        $AmountSalesCashDiscount = $reports_sales_cash->AmountSalesCashDiscount; 
        $qtdSellByCash = $reports_sales_cash->NumberOfSalesCash;
                
        return view('sections.reports.sales.index',
        compact('totalEarnings', 'NumberOfSales', 'AVGtotalEarnings', 
        'totalVAT',  'totalDiscount', 'AmountSalesWithVAT','AmountSalesWithoutVAT', 'qtdSellByCard', 'reports_sales_cash',
        'AmountSalesCashWithVAT', 'AmountSalesCashWithoutVAT', 'AmountSalesCashVAT', 'AmountSalesCashDiscount','qtdSellByCash',
        'qtdSellByCash', 'AmountSalesCardVAT', 'AmountSalesCardDiscount'));
    }


    public function searchIt(Request $request)
    {


        $tipo = $request->all();
        if($tipo == null){
            return redirect()
            ->route('sales.reports.index')
            ->with('status', 'No records was found on this range');
        }

        else {
        // $agora = date('Y/d/m');
        // return $less7days =  date('Y/d/m', strtotime('7 days', strtotime($agora)));

        if(isset($request->QuicklyOption)){
            $options = $request->QuicklyOption;
            if($options == 'sevenDays'){
                $start =date('Y-m-d H:i:s', strtotime('-1 month')) ;
                $end =  date('Y-m-d H:i:s');

            }
            else if($options == 'lastmonth'){
                $start ='Last Week: '. date('Y-m-d 00:00:00', strtotime('-1 month')) ."<br>";
                $end =  date('Y-m-d H:i:s');
 
            }
            else if($options == 'lastday'){
                
                $start = date('Y-m-d 00:00:00', strtotime('-1 day'));
                $end =  date('Y-m-d 00:00:00');
            }
            else if($options == 'today'){
                $start = date('Y-m-d 00:00:00');
                $end =  date('Y-m-d 23:59:59');
                
            }

        }

        else {

        // return 1;
        $dataComecoPadraoDateTime = $request->dataComecoPadraoDateTime;
        $dataFimPadraoDateTime =$request->dataFimPadraoDateTime;
        
        if($request->dataComecoPadraoDateTime == null || $request->dataFimPadraoDateTime == null){
            return redirect()->back();
        }

        // filtrando entre duas datas
        $start= date($dataComecoPadraoDateTime, time()); 
        $end= date($dataFimPadraoDateTime, time()); 
        $result = sales::whereBetween('created_at', array($start, $end))->get();

    }


        // baseado somente nos campos datas, sem nada a ver com o arquivo de pesquisa rapida
        // RETORNANDO VALORES
        $salesReportsGroups = DB::select('
        SELECT SUM(sales_price + 0 ) AS total, COUNT(*) QuantitySales, AVG(sales_price) as  AVGtotalAmount,
        SUM(sales_discount + 0) AS totalDiscount, SUM(sales_vat + 0) as totalVAT
        FROM sales where created_at BETWEEN ? and ?', [$start, $end])[0];
        if($salesReportsGroups->QuantitySales >  0){
            $totalEarnings = $salesReportsGroups->total;
            $NumberOfSales = $salesReportsGroups->QuantitySales;
            $AVGtotalEarnings = $salesReportsGroups->AVGtotalAmount;
            $totalVAT = $salesReportsGroups->totalVAT;
            $totalDiscount = $salesReportsGroups->totalDiscount;
        }
        else{
            // if there is no registers found
            return redirect()
            ->back()
            ->with('status', 'No records was found on this range');
            // return "nada nada nada nada..";

            // retonrar ou uma section avisando ou retornar pesquisa nula
        }

        // info sales by card
        // RETORNANDO VALORES
        
        $reports_sales_card = DB::select('
        SELECT COUNT(*) AS NumberOfSales, SUM(sales_price + 0 ) as AmountSalesWithVAT,
        SUM(sales_price - sales_vat) as AmountSalesWithoutVAT, SUM(sales_vat) as AmountSalesCardVAT, 
        SUM(sales_discount) as AmountSalesCardDiscount
        FROM sales
        where methodPayment = "CARD"
        and created_at BETWEEN ? and ?', [$start, $end])[0];
        // $reports_sales_card = salesbycard::all()->first();
        $AmountSalesWithVAT = $reports_sales_card->AmountSalesWithVAT; 
        $AmountSalesWithoutVAT = $reports_sales_card->AmountSalesWithoutVAT; 
        $AmountSalesCardVAT = $reports_sales_card->AmountSalesCardVAT; 
        $AmountSalesCardDiscount = $reports_sales_card->AmountSalesCardDiscount; 
        $qtdSellByCard = $reports_sales_card->NumberOfSales;

        // info sales by cash
        $reports_sales_cash = DB::select('
        SELECT COUNT(*) AS NumberOfSalesCash, SUM(sales_price + 0 ) as AmountSalesCashWithVAT,
        SUM(sales_price - sales_vat) as AmountSalesCashWithoutVAT, SUM(sales_vat) as AmountSalesCashVAT, SUM(sales_discount) as AmountSalesCashDiscount
        FROM sales
        where methodPayment = "CASH"
        and created_at BETWEEN ? and ?', [$start, $end])[0];

        // $reports_sales_cash = salesbycash::all()->first();
        $AmountSalesCashWithVAT = $reports_sales_cash->AmountSalesCashWithVAT; 
        $AmountSalesCashWithoutVAT = $reports_sales_cash->AmountSalesCashWithoutVAT; 
        $AmountSalesCashVAT = $reports_sales_cash->AmountSalesCashVAT; 
        $AmountSalesCashDiscount = $reports_sales_cash->AmountSalesCashDiscount; 
        $qtdSellByCash = $reports_sales_cash->NumberOfSalesCash;

        // return $start;

        return view('sections.reports.sales.index',
        compact('totalEarnings', 'NumberOfSales', 'AVGtotalEarnings', 
        'totalVAT',  'totalDiscount', 'AmountSalesWithVAT','AmountSalesWithoutVAT', 'qtdSellByCard', 'reports_sales_cash',
        'AmountSalesCashWithVAT', 'AmountSalesCashWithoutVAT', 'AmountSalesCashVAT', 'AmountSalesCashDiscount','qtdSellByCash',
        'qtdSellByCash', 'AmountSalesCardVAT', 'AmountSalesCardDiscount', 'start', 'end'));
    }
}

    public function salesreportsmonthly()
    {
                //  $products = productsSales::all();
                // $salesreportsmonthly = productsBestSellerByCategory::orderBy('totalNproducts', 'DESC')->get();

                // $salesreportsmonthly = salesreportsmonthly::orderBy('totalSalesAmount', 'DESC')->get();
                $salesreportsmonthly = salesreportsmonthly::all();
        
                $a = 1;
        
        
        
                // $products = \DB::table('products')
                // ->select('products.*')
                // ->orderBy('id','DESC')
                // ->get();
                // $results = DB::select('select * from products_sales where id = ?', [1]);
        
                /*query de exemplo 
                CREATE VIEW productsBestSellerByQuantities AS 
                SELECT  ProductId , COUNT(*) as totalNproducts, name, SKU, category, sales_price, Cost_Price, sales_discount, sales_vat, SUM(sales_price  + 0) as AmountSalesSell
                from products_sales
                GROUP BY ProductId ;
                */
        
                // $products = DB::select('select COUNT(*) as totalNproducts, name, SKU, category from  sales');
        
        
                // JSON format for Js can read this data
                // 200 means good reponses
                return response(json_encode($salesreportsmonthly), 200) ;
    }
}
