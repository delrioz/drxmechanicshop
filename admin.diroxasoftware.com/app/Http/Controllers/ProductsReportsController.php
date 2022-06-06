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
use App\productsAllinfos;
use App\productsSales;
use App\productsBestSellerByQuantities;
use App\productsBestSellerByCategory;
use App\stockpriceWithoutVat;

class ProductsReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        // return $products = productsBestSellerByQuantities::all();

        $allproducts = productsAllinfos::orderByRaw('name ASC')->get();
        // amount in products

        $stockPrice = StockPrice::all()->first()->stocksellPrice;
        
        // return $stockPrice = DB::table('products')
        // ->where(`SELECT SUM(Sell_PriceVat  *   quantity)  as stocksellPrice`)
        // ->where('quantity > 0');

        // $stockPrice = DB::table('products')
        //     ->select(DB::raw(' SUM(Sell_PriceVat  *   quantity)  as stocksellPrice'))
        //     ->where('quantity', '>', 1)
        //     ->groupBy('id');
         
        $stockPrice = number_format($stockPrice, 2, '.',',');


        $stockPriceWithoutVat = stockpriceWithoutVat::all()->first()->stocksellPrice;
        $stockPriceWithoutVat = number_format($stockPriceWithoutVat, 2, '.',',');


        // amount spent in products
        $stockCost = StockCost::all()->first()->stockCostPrice;
        $stockCost = number_format($stockCost, 2, '.',',');

        // Quantities products
        $StockTotalQuantity = StockTotalQuantity::all()->first()->nproductsquantity;


        $productsgeneralbalance = productsgeneralbalance::all()->first()->total;
        $productsgeneralbalance = number_format($productsgeneralbalance, 2, '.',',');



        $allproductsLowQuantity = lowquantity::paginate(10);

        $allcostbenefit = costbenefit::paginate(3);

        $allworstcostbenefit = worstcostbenefit::paginate(3);

        
        return view('sections.reports.products.index', compact('stockPriceWithoutVat', 'allproducts', 'stockPrice', 'stockCost', 'StockTotalQuantity', 'productsgeneralbalance', 'allproductsLowQuantity', 'allcostbenefit', 'allworstcostbenefit'));
    }


    public function all(Request $request)
    {

        //  $products = productsSales::all();
        
        $products = productsBestSellerByQuantities::orderBy('totalNproducts', 'DESC')->get();
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

        return response(json_encode($products, $a), 200) ;
}

    public function allbycategories(Request $request)
    {

        //  $products = productsSales::all();
        $productsByCategory = productsBestSellerByCategory::orderBy('totalNproducts', 'DESC')->get();


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
        return response(json_encode($productsByCategory), 200) ;
    }



    public function allLowqtsProducts(){
        $allproducts = lowquantity::all();
        return view('sections.reports.products.lowproducts', compact('allproducts'));

    }

}
