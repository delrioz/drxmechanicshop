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
use App\totalearningstoday;
use App\productSales;
use App\ProductbestSeller;
use App\overvieweachproductsales;
use App\Exports\EachProductSalesReports;
use Maatwebsite\Excel\Facades\Excel;


class SalesReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $ProductbestSeller = DB::table('ProductbestSeller')
        ->orderBy('totalQuantitySales', 'desc')
        ->first();
        
        if($ProductbestSeller == ""){
            $productsFound = 0;
        }
        else {
            $productsFound = 1;
        }


        
        // return   $salesreportsmonthly = salesreportsmonthly::orderBy('totalSalesAmount', 'DESC')->get();
        // salesPriceinProducts

        // $allsales = productSales::all();
          $allsales = overvieweachproductsales::orderBy('thisProductSalesTotalQuantity', 'ASC')->get();

        //   $allsales = DB::select(' SELECT ps.id, ps.name, ps.SKU, ps.category, ps.brand, ps.image, ps.Sell_Price, ps.Cost_Price, ps.quantity,
        //             ps.about, ps.machines, ps.sales_price, ps.sales_discount, ps.sales_vat, ps.ProductId, ps.methodPayment, ps.salesid,
        //             ps.totalSalesWithoutVat, ps.totalSalesWithVat, ps.totalSalesDiscount, ps.created_at, ps.updated_at,
        //             sum(ps.totalSalesWithVat + 0) as thisProductTotalSales, sum(ps.quantity) as thisProductSalesTotalQuantity,
        //             sum(ps.Cost_Price) as thisProductCostPriceTotalQuantity
        //             from products_sales ps
        //             GROUP BY ProductId
        //             ORDER BY thisProductSalesTotalQuantity'
        //  );


        // total earningsToday
        $todayDate =  date('Y-m-d');
        $findearningstoday = totalearningstoday::where('created_at', 'LIKE', $todayDate)->first();
        // $totalearningstoday = $findearningstoday->totaltoday;

        if($findearningstoday == null){
            $totalearningstoday = 0;
        }
        else{
             $totalearningstoday = $findearningstoday->totaltoday;
        }

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

        $totalEarnings = number_format($totalEarnings, 2, '.',',');
        $AVGtotalEarnings = number_format($AVGtotalEarnings, 2, '.',',');
        $totearningstoday = number_format($totalearningstoday, 2, '.',',');

        $AmountSalesWithVAT = number_format($AmountSalesWithVAT, 2, '.',',');
        $AmountSalesWithoutVAT = number_format($AmountSalesWithoutVAT, 2, '.',',');
        $AmountSalesCardVAT = number_format($AmountSalesCardVAT, 2, '.',',');
        $AmountSalesCardDiscount = number_format($AmountSalesCardDiscount, 2, '.',',');

        $AmountSalesCashWithVAT = number_format($AmountSalesCashWithVAT, 2, '.',',');
        $AmountSalesCashWithoutVAT = number_format($AmountSalesCashWithoutVAT, 2, '.',',');
        $AmountSalesCashDiscount = number_format($AmountSalesCashDiscount, 2, '.',',');
        $AmountSalesCashVAT = number_format($AmountSalesCashVAT, 2, '.',',');


        return view('sections.reports.sales.index',
                compact('ProductbestSeller','productsFound','totalEarnings', 'NumberOfSales', 'AVGtotalEarnings',
                'totalVAT', 'totalDiscount', 'AmountSalesWithVAT','AmountSalesWithoutVAT', 'qtdSellByCard', 'reports_sales_cash',
                'AmountSalesCashWithVAT', 'AmountSalesCashWithoutVAT', 'AmountSalesCashVAT', 'AmountSalesCashDiscount','qtdSellByCash',
                'qtdSellByCash', 'AmountSalesCardVAT', 'AmountSalesCardDiscount', 'totalearningstoday', 'totearningstoday', 'allsales'));
                
    }


    public function searchIt(Request $request)
    {


        // return $request;
        $allsales = overvieweachproductsales::orderBy('thisProductSalesTotalQuantity', 'ASC')->get();

        // $allsales = DB::select(' SELECT ps.id, ps.name, ps.SKU, ps.category, ps.brand, ps.image, ps.Sell_Price, ps.Cost_Price, ps.quantity,
        //     ps.about, ps.machines, ps.sales_price, ps.sales_discount, ps.sales_vat, ps.ProductId, ps.methodPayment, ps.salesid,
        //     ps.totalSalesWithoutVat, ps.totalSalesWithVat, ps.totalSalesDiscount, ps.created_at, ps.updated_at,
        //     sum(ps.totalSalesWithVat + 0) as thisProductTotalSales, sum(ps.quantity) as thisProductSalesTotalQuantity,
        //     sum(ps.Cost_Price) as thisProductCostPriceTotalQuantity
        //     from products_sales ps
        //     GROUP BY ProductId
        //     ORDER BY thisProductSalesTotalQuantity'
        // );

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
                $start =date('Y-m-d', strtotime('-1 week')) ;
                $end =  date('Y-m-d');

            }
            else if($options == 'lastmonth'){
                $start =date('Y-m-d', strtotime('-1 month')) ;
                $end =  date('Y-m-d');

            }
            else if($options == 'lastday'){

                $start = date('Y-m-d', strtotime('-1 day'));
                $end =  date('Y-m-d');
            }
            else if($options == 'today'){
                $start = date('Y-m-d');
                $end =  date('Y-m-d');

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
        SELECT SUM(totalToBePaid + 0 ) AS total, COUNT(*) QuantitySales, AVG(sales_price) as  AVGtotalAmount,
        SUM(sales_discount + 0) AS totalDiscount, SUM(sales_vat + 0) as totalVAT
        FROM sales
        where created_at BETWEEN ? and ?', [$start, $end])[0];
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
        SELECT COUNT(*) AS NumberOfSales, SUM(totalToBePaid + 0 ) as AmountSalesWithVAT,
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
        SELECT COUNT(*) AS NumberOfSalesCash, SUM(totalToBePaid + 0 ) as AmountSalesCashWithVAT,
        SUM(sales_price - sales_vat) as AmountSalesCashWithoutVAT,
        SUM(sales_vat) as AmountSalesCashVAT, SUM(sales_discount) as AmountSalesCashDiscount
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

        // FINDING TOTAL earningsToday
        $todayDate =  date('Y-m-d');
        $findearningstoday = totalearningstoday::where('created_at', 'LIKE', $todayDate)->first();
        // $totalearningstoday = $findearningstoday->totaltoday;

        if($findearningstoday == null){
            $totalearningstoday = 0;
        }
        else{
                $totalearningstoday = $findearningstoday->totaltoday;
        }
        $totearningstoday = number_format($totalearningstoday, 2, '.',',');


        $totalEarnings = number_format($totalEarnings, 2, '.',',');
        // $NumberOfSales = number_format($NumberOfSales, 2, '.',',');
        $AVGtotalEarnings = number_format($AVGtotalEarnings, 2, '.',',');
        $totalVAT = number_format($totalVAT, 2, '.',',');
        $totalDiscount = number_format($totalDiscount, 2, '.',',');
        $AmountSalesWithVAT = number_format($AmountSalesWithVAT, 2, '.',',');
        $AmountSalesWithoutVAT = number_format($AmountSalesWithoutVAT, 2, '.',',');
        // $qtdSellByCard = number_format($qtdSellByCard, 2, '.',',');
        // $reports_sales_cash = number_format($reports_sales_cash, 2, '.',',');
        $AmountSalesCashWithVAT = number_format($AmountSalesCashWithVAT, 2, '.',',');;
        $AmountSalesCashWithoutVAT = number_format($AmountSalesCashWithoutVAT, 2, '.',',');
        $AmountSalesCashDiscount = number_format($AmountSalesCashDiscount, 2, '.',',');
        // $qtdSellByCash = number_format($qtdSellByCash, 2, '.',',');
        $AmountSalesCardDiscount = number_format($AmountSalesCardDiscount, 2, '.',',');
        $AmountSalesCashVAT = number_format($AmountSalesCashVAT, 2, '.',',');
        $AmountSalesCardVAT = number_format($AmountSalesCardVAT, 2, '.',',');


        $ProductbestSeller = ProductbestSeller::all()->first();

            if($ProductbestSeller == ""){
                $productsFound = 0;
            }
            else {
                $productsFound = 1;
            }


        return view('sections.reports.sales.index',
        compact('totalEarnings', 'NumberOfSales', 'AVGtotalEarnings',
        'totalVAT',  'totalDiscount', 'AmountSalesWithVAT','AmountSalesWithoutVAT', 'qtdSellByCard', 'reports_sales_cash',
        'AmountSalesCashWithVAT', 'AmountSalesCashWithoutVAT', 'AmountSalesCashVAT', 'AmountSalesCashDiscount','qtdSellByCash',
        'qtdSellByCash', 'AmountSalesCardVAT', 'AmountSalesCardDiscount', 'start', 'end', 'totearningstoday', 'allsales', 'ProductbestSeller', 'productsFound'));
    }
}

    public function searchajax(Request $request)
    {


              $start =  $request->dataComecoPadraoDateTime;
              $end = $request->dataFimPadraoDateTime;
              $allsales = Sales::all();

              // baseado somente nos campos datas, sem nada a ver com o arquivo de pesquisa rapida
              // RETORNANDO VALORES
              $salesReportsGroups = DB::select('
              SELECT SUM(totalToBePaid + 0 ) AS total, COUNT(*) QuantitySales, AVG(sales_price) as  AVGtotalAmount,
              SUM(sales_discount + 0) AS totalDiscount, SUM(sales_vat + 0) as totalVAT
              FROM sales
              where created_at BETWEEN ? and ?', [$start, $end])[0];

              if($salesReportsGroups->QuantitySales >  0){

                  $totalEarnings = $salesReportsGroups->total;
                  $NumberOfSales = $salesReportsGroups->QuantitySales;
                  $AVGtotalEarnings = $salesReportsGroups->AVGtotalAmount;
                  $totalVAT = $salesReportsGroups->totalVAT;
                  $totalDiscount = $salesReportsGroups->totalDiscount;
              }
              else{
                  // if there is no registers found
                //   return redirect()
                //   ->back()
                //   ->with('status', 'No records was found on this range');
                return "NDA";

                  // retonrar ou uma section avisando ou retornar pesquisa nula
              }


            // info sales by card
            // RETORNANDO VALORES
            $reports_sales_card = DB::select('
            SELECT COUNT(*) AS NumberOfSales, SUM(totalToBePaid + 0 ) as AmountSalesWithVAT,
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
            SELECT COUNT(*) AS NumberOfSalesCash, SUM(totalToBePaid + 0 ) as AmountSalesCashWithVAT,
            SUM(sales_price - sales_vat) as AmountSalesCashWithoutVAT, SUM(sales_vat) as AmountSalesCashVAT, SUM(sales_discount) as AmountSalesCashDiscount
            FROM sales
            where methodPayment = "cash"
            and created_at BETWEEN ? and ?', [$start, $end])[0];

            // $reports_sales_cash = salesbycash::all()->first();
            $AmountSalesCashWithVAT = $reports_sales_cash->AmountSalesCashWithVAT;
            $AmountSalesCashWithoutVAT = $reports_sales_cash->AmountSalesCashWithoutVAT;
            $AmountSalesCashVAT = $reports_sales_cash->AmountSalesCashVAT;
            $AmountSalesCashDiscount = $reports_sales_cash->AmountSalesCashDiscount;
            $qtdSellByCash = $reports_sales_cash->NumberOfSalesCash;


            $totalEarnings = number_format($totalEarnings, 2, '.',',');
            // $NumberOfSales = number_format($NumberOfSales, 2, '.',',');
            $AVGtotalEarnings = number_format($AVGtotalEarnings, 2, '.',',');
            $totalVAT = number_format($totalVAT, 2, '.',',');
            $totalDiscount = number_format($totalDiscount, 2, '.',',');
            $AmountSalesWithVAT = number_format($AmountSalesWithVAT, 2, '.',',');
            $AmountSalesWithoutVAT = number_format($AmountSalesWithoutVAT, 2, '.',',');
            // $qtdSellByCard = number_format($qtdSellByCard, 2, '.',',');
            // $reports_sales_cash = number_format($reports_sales_cash, 2, '.',',');
            $AmountSalesCashWithVAT = number_format($AmountSalesCashWithVAT, 2, '.',',');;
            $AmountSalesCashWithoutVAT = number_format($AmountSalesCashWithoutVAT, 2, '.',',');
            $AmountSalesCashDiscount = number_format($AmountSalesCashDiscount, 2, '.',',');
            // $qtdSellByCash = number_format($qtdSellByCash, 2, '.',',');
            $AmountSalesCardDiscount = number_format($AmountSalesCardDiscount, 2, '.',',');
            $AmountSalesCashVAT = number_format($AmountSalesCashVAT, 2, '.',',');
            $AmountSalesCardVAT = number_format($AmountSalesCardVAT, 2, '.',',');


            $totalEarnings == null ? $totalEarnings =  '0.00' : $totalEarnings;
            $NumberOfSales == null ? $NumberOfSales =  '0.00' : $NumberOfSales;
            $AVGtotalEarnings == null ? $AVGtotalEarnings =  '0.00' : $AVGtotalEarnings;
            $totalVAT == null ? $totalVAT = '0.00' : $totalVAT;
            $totalDiscount == null ? $totalDiscount =  '0.00' : $totalDiscount;
            $AmountSalesWithVAT == null ? $AmountSalesWithVAT =  '0.00' : $AmountSalesWithVAT;
            $AmountSalesWithoutVAT == null ? $AmountSalesWithoutVAT =  '0.00' : $AmountSalesWithoutVAT;
            $qtdSellByCard == null ? $qtdSellByCard =  0 : $qtdSellByCard;
            $reports_sales_cash == null ? $reports_sales_cash =  '0.00' : $reports_sales_cash;
            $AmountSalesCashWithVAT == null ? $AmountSalesCashWithVAT =  '0.00' : $AmountSalesCashWithVAT;
            $AmountSalesCashWithoutVAT == null ? $AmountSalesCashWithoutVAT =  '0.00' : $AmountSalesCashWithoutVAT;
            $AmountSalesCashVAT == null ? $AmountSalesCashVAT =  '0.00' : $AmountSalesCashVAT;
            $AmountSalesCashDiscount == null ? $AmountSalesCashDiscount =  '0.00' : $AmountSalesCashDiscount;
            $qtdSellByCash == null ? $qtdSellByCash =  0 : $qtdSellByCash;
            $AmountSalesCardVAT == null ? $AmountSalesCardVAT =  '0.00' : $AmountSalesCardVAT;
            $AmountSalesCardDiscount == null ? $AmountSalesCardDiscount =  '0.00' : $AmountSalesCardDiscount;

            $start = date('d/m/Y', strtotime($start));
            $end = date('d/m/Y', strtotime($end));



            //   return $datasFound=[$totalEarnings, $NumberOfSales, $AVGtotalEarnings ];
             return $datasFound = ['totalEarnings' => $totalEarnings,
              'NumberOfSales' => $NumberOfSales,
              'AVGtotalEarnings' => $AVGtotalEarnings,
              'totalVAT' => $totalVAT,
              'totalDiscount' => $totalDiscount,
              'AmountSalesWithVAT' => $AmountSalesWithVAT,
              'AmountSalesWithoutVAT' => $AmountSalesWithoutVAT,
              'qtdSellByCard' => $qtdSellByCard,
              'reports_sales_cash' => $reports_sales_cash,
              'AmountSalesCashWithVAT' => $AmountSalesCashWithVAT,
              'AmountSalesCashWithoutVAT' => $AmountSalesCashWithoutVAT,
              'AmountSalesCashVAT' => $AmountSalesCashVAT,
              'AmountSalesCashDiscount' => $AmountSalesCashDiscount,
              'qtdSellByCash' => $qtdSellByCash,
              'AmountSalesCardVAT' => $AmountSalesCardVAT,
              'AmountSalesCardDiscount' => $AmountSalesCardDiscount,
              'start' => $start,
              'end' => $end,
              ];



              return view('sections.reports.sales.index',
              compact('totalEarnings', 'NumberOfSales', 'AVGtotalEarnings',
              'totalVAT',  'totalDiscount', 'AmountSalesWithVAT','AmountSalesWithoutVAT', 'qtdSellByCard', 'reports_sales_cash',
              'AmountSalesCashWithVAT', 'AmountSalesCashWithoutVAT', 'AmountSalesCashVAT', 'AmountSalesCashDiscount','qtdSellByCash',
              'qtdSellByCash', 'AmountSalesCardVAT', 'AmountSalesCardDiscount', 'start', 'end', 'allsales'));
    }


    public function salesreportsmonthly()
    {

                 $salesreportsmonthly = DB::select('SELECT * FROM salesreportspermonth');

                // $products = DB::select('select COUNT(*) as totalNproducts, name, SKU, category from  sales');

                // JSON format for Js can read this data
                // 200 means good reponses
                return response(json_encode($salesreportsmonthly), 200) ;
    }


    public function export()
    {
        return Excel::download(new EachProductSalesReports, 'eachproductsales.xlsx');
    }


}


// Estou elaborando essa logica pro left join a partir de uma tabela sales_dates que eu criei. Onde date é o campo com os meses (1 ao 12)
// SELECT count(0) AS Nsales, sum(sales.sales_price + 0) AS totalSalesAmount, sum(sales.sales_discount + 0) AS totalSalesDiscount,
// sum(sales.sales_vat + 0) AS totalSalesVAT,
//  date_format(sales.created_at,'%d') AS daySales,
//  date_format(sales.created_at,'%c') AS monthSales, sales.created_at AS created_at,
//  date_format(sales.created_at,'%Y') AS yearSales,
//  sd.date
//   FROM sales
//   LEFT OUTER JOIN sales_dates as sd ON (sd.date = date_format(sales.created_at,'%c'))
// GROUP BY date_format(sales.created_at,'%c') ORDER BY created_at ASC


// SELECT srp.Nsales, srp.totalSalesAmount, srp.totalSalesDiscount, srp.totalSalesVAT, srp.daySales, srp.monthSales, srp.created_at, srp.yearSales, sd.date
// FROM salesreportsmonthly srp
// LEFT OUTER JOIN sales_dates as sd ON (sd.date = srp.monthSales);
