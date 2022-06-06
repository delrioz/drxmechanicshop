<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\productsSales;
use App\Category;
use App\supplier;
use App\internalmachines;


class BuySectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $allproducts = Product::all();
        $allcustomers = Customer::all();
        $routeBack = "index";
        $allcategories = Category::orderByRaw('name ASC')->get();
        $allSuppliers = supplier::all();
        $allmachines = internalmachines::all();
        $backRoute = "welcomePage";

        return view('sections.buysection.index', compact('allproducts', 'routeBack', 'allcustomers', 'allcategories', 'allSuppliers', 'allmachines', 'backRoute'));
    }

    public function finishingbuy(Request $request)
    {   
        return $request;
        
        //isso é considerado array:
        //  $newVar = ["{nome:giovani, idade:30, sexo:masculino}, {nome:gui, idade:15, sexo:masculino},"];
        // return gettype($newVar);

        // return $request;
        $request->productsSellprice;
        $sum = array_sum($request->productsSellprice);
        $dataArray =  $request->productsId;


        $max4 = sizeof($dataArray);
        for($j =0; $j < $max4; $j++)
        {
                $prodsPrice =  $request->productsSellprice[$j];
                $prodQuantity =  $request->quantity[$j];
                $tot = $prodsPrice * $prodQuantity;
        }
           
        
        if(isset($dataArray)){
        // cadastrando na tabela sales

        // aqui vem todos os dadodos do pagamento realizado
        $createSales = new sales();
        $createSales->sales_price = $totalvalue; // valor total da compra
        $createSales->sales_subtotal = $subtotalvalue; // valor sem vat
        $createSales->sales_discount = $sales_discount; // valor do campo desconto
        $createSales->sales_vat = $vat; // valor apenas do vat
        $createSales->methodPayment = $paymentMethod; // metodo de pagamento 
        $storeProductsSales = $createSales->save();
        $SalesID= $createSales->id;
        $created_at= $createSales->created_at;

        $salesInvoice = DB::insert('insert into sales_invoice (salesReference, created_at) values (?, ?)', [$SalesID, $created_at]);

        $max4 = sizeof($dataArray);
        for($i =0; $i < $max4; $i++)
        {
                $id =  $request->productsId[$i];
                $quantityProductsSelected = $request->quantityProducts[$i];

                $achadoProduct =  Product::find($id)->first();

                if($achadoProduct)
                    $IdProduct = $achadoProduct->id;
                    $nameProduct = $achadoProduct->name;
                    // $SKU = $achadoProduct->SKU;
                    $category = $achadoProduct->category;
                    $brand = $achadoProduct->brand;
                    $image = $achadoProduct->image;
                    $Sell_Price = $achadoProduct->Sell_Price;
                    $Sell_PriceVat = $achadoProduct->Sell_PriceVat;
                    $Cost_Price = $achadoProduct->Cost_Price;
                    $quantity = $achadoProduct->quantity;
                    $about = $achadoProduct->about;
                    $machines = $achadoProduct->machines;
                
                if($achadoProduct){
                    // decrementando a quantidade vendida da tabela products
                    $quantityProductsSelected;
                    $prod =  Product::find($id)->first();
                    $prod->quantity = $prod->quantity-=$quantityProductsSelected;
                    $updateProd = $prod->save();

                if($updateProd){

                    $unitPrice = $achadoProduct->Sell_Price; // preço do produto que ta sendo vendido
                    $price = $unitPrice * $quantityProductsSelected; // preço do produto que ta sendo vendido vezes a quantidade
                    $discount = 0;
                    $SalesID = 1;
                    $varpricewithvat =($unitPrice * 1.20);
                    // return $sum =  array_sum($price);

                    /// Estamos apenas fazendo a inserção dos produtos vendidos em si
                    $createProductsSales = new productsSales();
                    $createProductsSales->name = $prod->name;
                    $createProductsSales->SKU = $prod->SKU;
                    $createProductsSales->category =  $prod->category;
                    $createProductsSales->brand =  $prod->brand;
                    $createProductsSales->image = $image;
                    $createProductsSales->Sell_Price = $prod->Sell_Price;
                    $createProductsSales->Cost_Price = $prod->Cost_Price;
                    $createProductsSales->quantity = $quantityProductsSelected;
                    $createProductsSales->about = $about;
                    $createProductsSales->machines = $machines;
                    $createProductsSales->sales_price = $price;
                    $createProductsSales->sales_discount =  0;
                    $createProductsSales->sales_vat =  ($price *0.20);
                    $createProductsSales->methodPayment = "card";
                    $createProductsSales->salesId = 1;          
                    $createProductsSales->totalSalesWithoutVat = (($unitPrice - $discount) * $quantityProductsSelected);          
                    $createProductsSales->totalSalesWithVat = ($varpricewithvat - $discount) * $quantityProductsSelected; 
                    $createProductsSales->totalSalesDiscount =1;          
                    $createProductsSales->ProductId =$id;
                    $storeProductsSales = $createProductsSales->save();
            }
        }
    }
    return $SalesID;
  }
}
    
}
