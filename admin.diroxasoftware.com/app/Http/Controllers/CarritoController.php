<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\tabelaTeste;
use App\sales;
use App\productsSales;
use App\allinfosproductssales;
use App\productsales_payments;
use App\productsAllinfos;
use App\sales_invoice;
use App\Customer;
use DB;

class CarritoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $allproducts = productsallinfos::all();
        return view('sections.carrito.index', compact('allproducts'));
    }

    public function processarCompra()
    {
        return view('sections.carrito.compra');

    }

    public function generatingInvoice(Request $request)
    {
        return json_encode($request);

    }

  
        public function generatingInvoiceAjax(Request $request)
    {   


        //isso é considerado array:
        //  $newVar = ["{nome:giovani, idade:30, sexo:masculino}, {nome:gui, idade:15, sexo:masculino},"];
        // return gettype($newVar);
        

        $dataArray =  $request["data"];



        if(isset($dataArray)){
        // $newDataArray =    json_decode($dataArray);
        // return gettype($newDataArray );

        // pegando os daods gerais para cadastro na tabela sales 
            $totalvalue = $request["data"][0]["totalvalue"];
            $subtotalvalue = $request["data"][0]["subtotalvalue"];
            $vat = $request["data"][0]["vat"];
            $paymentMethod = $request["data"][0]["paymentMethod"];
            $sales_discount = $request["data"][0]["sales_discount"];
            $paymentsOptions = $request["data"][0]["paymentsOptions"];
            $Npayments = $request["data"][0]["Npayments"];
            $lastPaymentDate = $request["data"][0]["lastPaymentDate"]; 
            $chooseCustomer = $request["data"][0]["chooseCustomer"];
            $firstAmountPaid = $request["data"][0]["firstAmountPaid"];
            $upfrontValue = $request["data"][0]["upfront"];
            $firstPaymentDate = $request["data"][0]["primeiraDatadoPagamento"];
            
            $Npayments == null ? $Npayments =  1 : $Npayments = $Npayments;

            $paymentMethod == "PAYING TODAY" ? $upfrontValue =  0.00 : $upfrontValue = $upfrontValue;

            if($firstPaymentDate == 0){
                $firstPaymentDate =  $lastPaymentDate;
            }
            else{
                $firstPaymentDate = $firstPaymentDate;
            }

            $todayDate = date('d/m/Y');

            if($firstPaymentDate == $todayDate)
            {
                $NpaymentsNumber = $Npayments - 1;
            }
            else{
                $NpaymentsNumber = $Npayments; // caso  so vai cobrar o upfront hoje e vai iniciar os pagemntos depois
            }
            

            if($paymentsOptions == "PAYING TODAY"){
                $firstAmountPaid = $totalvalue + $upfrontValue;
                $newSalesPriceTotalValue = $firstAmountPaid; // that case nothing changes
                $status = 0; // status 0 means closed, paid.
            }
            else{
                    $newSalesPriceTotalValue = $firstAmountPaid + $upfrontValue; // é o valor que vai começar a contar
                    $status = 1;
                    $firstPaymentDate != $todayDate ? $newSalesPriceTotalValue = $upfrontValue : $newSalesPriceTotalValue = $firstAmountPaid + $upfrontValue;
            }


            // $newTotalToBePaid = $totalvalue - $upfrontValue; // was
            $newTotalToBePaid = $totalvalue;
            $newTotalToBePaid = number_format($newTotalToBePaid, 2, '.',',');

          
            // aqui vem todos os dadodos do pagamento realizado
            $createSales = new sales();
            $createSales->sales_price = $newSalesPriceTotalValue; // valor total da compra (que em alguns casos sera o valor pago ate agora)
            $createSales->sales_subtotal = $subtotalvalue; // valor sem vat
            $createSales->sales_discount = $sales_discount; // valor do campo desconto
            $createSales->sales_vat = $vat; // valor apenas do vat
            $createSales->methodPayment = $paymentMethod; // metodo de pagamento 
            $createSales->paymentsOptions = $paymentsOptions; // tipo de pagamento, para saber se é tudo agora ou parcelado
            $createSales->Npayments = $Npayments; // numero de pagamentos que vao ser realizados
            $createSales->NpaymentsLeft = $NpaymentsNumber; // numero de pagamentos que ainda faltam serem realizados
            $createSales->lastPaymentDate = $lastPaymentDate; // é na verdade a ultima data do pagamento
            $createSales->firstPaymentDate = $firstPaymentDate; // é na verdade a ultima data do pagamento
            $createSales->chooseCustomer = $chooseCustomer; 
            $createSales->firstAmountPaid = $firstAmountPaid; 
            $createSales->status = $status; 
            $createSales->totalToBePaid = $newTotalToBePaid;  // that means the total of the bills but that we problably didnt receive yet
            $createSales->upfrontValue = $upfrontValue;  // that means the total of the bills but that we problably didnt receive yet
            $storeProductsSales = $createSales->save();

            $SalesID= $createSales->id;
            $created_at= $createSales->created_at;

            $newCreatedAt = date('d/m/Y', strtotime($created_at));

            // CarritoControllercadatrar na tabela sales_invoice
            // $newInvoice = new sales_invoice;
            // $newInvoice->salesReference = 2;
            // $createInvoice = $newInvoice->save();
            $salesInvoice = DB::insert('insert into sales_invoice (salesReference, created_at) values (?, ?)', [$SalesID, $created_at]);

        
        // cadastrando na tabela sales

        foreach($dataArray as $dA){
                $id = $dA["id"];
                $image = $dA["imagen"];
                $price = $dA["precio"];
                $pricewithvat = $dA["precioconVAT"];
                $name = $dA["titulo"];
                $cantidad = $dA["cantidad"];
                $SKU = $dA["SKU"];
                
                $achadoProduct =  Product::find($id);

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
                    $prod = Product::find($id);
                    $prod->quantity = $prod->quantity-=$cantidad;
                    $updateProd = $prod->save();

                if($updateProd){

                    $discount = 0;
                    $varpricewithvat = $price + ($price *0.20);

                    /// Estamos apenas fazendo a inserção dos produtos vendidos em si
                    $createProductsSales = new productsSales();
                    $createProductsSales->name = $prod->name;
                    $createProductsSales->SKU = $prod->SKU;
                    $createProductsSales->category =  $prod->category;
                    $createProductsSales->brand =  $prod->brand;
                    $createProductsSales->image = $image;
                    $createProductsSales->Sell_Price = $prod->Sell_Price;
                    $createProductsSales->Cost_Price = $prod->Cost_Price;
                    $createProductsSales->quantity = $cantidad;
                    $createProductsSales->about = $about;
                    $createProductsSales->machines = $machines;
                    $createProductsSales->sales_price = $price;
                    $createProductsSales->sales_discount =  0;
                    $createProductsSales->sales_vat =  ($price *0.20);
                    $createProductsSales->methodPayment = $paymentMethod;
                    $createProductsSales->salesId = $SalesID;          
                    $createProductsSales->totalSalesWithoutVat = (($price - $discount) * $cantidad);          
                    $createProductsSales->totalSalesWithVat = ($varpricewithvat - $discount) * $cantidad; 
                    $createProductsSales->totalSalesDiscount =1;          
                    $createProductsSales->ProductId =$id;
                    $storeProductsSales = $createProductsSales->save();
            }
        }
    }

    return $SalesID;
}

    }

    public function invoice($id)
    {   
        

           $salesId = $id;
                // products in this sale
           $ProductsInfos2 = allinfosproductssales::where('salesId', 'LIKE', "%{$salesId}%")->get();
            
           // puxando da tabela sales onde ficam todas  as vendas ja realizadas
           $salesInfos = sales::find($salesId);
           $sales_price = $salesInfos->sales_price;
           $sales_subtotal  = $salesInfos->sales_subtotal;
           $sales_discount = $salesInfos->sales_discount;
           $sales_vat = $salesInfos->sales_vat;
           $totalSalesWithVat = $salesInfos->totalSalesWithVat;
           $totalSalesDiscount = $salesInfos->totalSalesDiscount;
           $methodPayment = $salesInfos->methodPayment;
           $customer = $salesInfos->chooseCustomer;
           $firstAmountPaid = $salesInfos->firstAmountPaid;
           $totalToBePaid = $salesInfos->totalToBePaid;

           $paymentsOptions = $salesInfos->paymentsOptions;

           $thisCustomer  = Customer::find($customer);

           if($thisCustomer == "" || $thisCustomer == null){
                $msgThisCustomer = "NotFound";
            }
            else {
                $msgThisCustomer = "CustomerFounded";
            }
           
           $typesales = 0;

           $sales_price = number_format($sales_price, 2, '.',',');
           $sales_subtotal = number_format($sales_subtotal, 2, '.',',');
           $sales_discount = number_format($sales_discount, 2, '.',',');
           $sales_vat = number_format($sales_vat, 2, '.',',');
           $totalSalesWithVat = number_format($totalSalesWithVat, 2, '.',',');
           $totalSalesDiscount = number_format($totalSalesDiscount, 2, '.',',');
           $firstAmountPaid = number_format($firstAmountPaid, 2, '.',',');
           $totalToBePaid = number_format($totalToBePaid, 2, '.',',');
           
        //    return $paymentsOptions

        //  return view('sections.printertemplate', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount',
        //                 'sales_vat', 'methodPayment', 'sales_subtotal', 'typesales'));

        $NpaymentsLeft = $salesInfos->NpaymentsLeft;
        $Npayments = $salesInfos->Npayments;
        $upfrontValue = number_format($salesInfos->upfrontValue , 2, '.',',');
        $salesDate = date('d/m/Y', strtotime($salesInfos->created_at));


           return view('sections.carrito.invoice', compact('thisCustomer', 'salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount',
                        'thisCustomer', 'msgThisCustomer', 'salesDate', 'upfrontValue', 'Npayments', 'sales_vat', 'methodPayment', 'sales_subtotal', 'typesales', 'totalSalesWithVat', 'totalSalesDiscount', 'firstAmountPaid',
                        'totalToBePaid', 'paymentsOptions', 'NpaymentsLeft'));

    }


    public function balance($id = null, $from = null)
    {

        $salesId = $id;
                // products in this sale
        $ProductsInfos2 = allinfosproductssales::where('salesId', 'LIKE', "%{$salesId}%")->get();


        // puxando da tabela sales onde ficam todas  as vendas ja realizadas
        $salesInfos = sales::find($salesId);
            if($salesInfos == "" || $salesInfos == "[]"){
                return redirect()
                ->back();    
        }
        
        $sales_price = $salesInfos->sales_price;
        $sales_subtotal  = $salesInfos->sales_subtotal;
        $sales_discount = $salesInfos->sales_discount;
        $sales_vat = $salesInfos->sales_vat;
        $totalSalesWithVat = $salesInfos->totalSalesWithVat;
        $totalSalesDiscount = $salesInfos->totalSalesDiscount;
        $methodPayment = $salesInfos->methodPayment;
        $methodPayment = $salesInfos->methodPayment;
        $upfrontValue = $salesInfos->upfrontValue;

        $typesales = 0;

        $totalamountToreceive = $upfrontValue + $sales_price;

        $totalamountToreceive = number_format($totalamountToreceive, 2, '.',',');
        $sales_price = number_format($sales_price, 2, '.',',');
        $sales_subtotal = number_format($sales_subtotal, 2, '.',',');
        $sales_discount = number_format($sales_discount, 2, '.',',');
        $sales_vat = number_format($sales_vat, 2, '.',',');
        $totalSalesWithVat = number_format($totalSalesWithVat, 2, '.',',');
        $totalSalesDiscount = number_format($totalSalesDiscount, 2, '.',',');
        $upfrontValue = number_format($upfrontValue, 2, '.',',');


        
        return view('sections.carrito.balanceView', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount',
        'sales_vat', 'totalamountToreceive', 'upfrontValue', 'methodPayment', 'sales_subtotal', 'typesales', 'totalSalesWithVat', 'totalSalesDiscount', 'from'));

    }

    public function customersreceipt($id)
    {   
            
           $salesId = $id;
                // products in this sale
           $ProductsInfos2 = allinfosproductssales::where('salesId', 'LIKE', "%{$salesId}%")->get();

           // puxando da tabela sales onde ficam todas  as vendas ja realizadas
           $salesInfos = sales::find($salesId);
           $sales_price = $salesInfos->sales_price;
           $sales_subtotal  = $salesInfos->sales_subtotal;
           $sales_discount = $salesInfos->sales_discount;
           $sales_vat = $salesInfos->sales_vat;
           $totalSalesWithVat = $salesInfos->totalSalesWithVat;
           $totalSalesDiscount = $salesInfos->totalSalesDiscount;
           $methodPayment = $salesInfos->methodPayment;
           $description = $salesInfos->description;

           $typesales = 0;


           if($description == 'standard'){
            $typesales = 0;
            }
            else{
                $typesales = 1 ;
            }
         

         return view('sections.printertemplate', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount',
                        'sales_vat', 'methodPayment', 'sales_subtotal', 'typesales', 'description'));

        //    return view('sections.carrito.invoice', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount',
        //                 'sales_vat', 'methodPayment', 'sales_subtotal', 'typesales'));

    }
}