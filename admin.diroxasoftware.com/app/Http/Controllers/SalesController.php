<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\allasales;
use App\invoicetable;
use App\Customer;
use App\allinfosproductssales;
use App\productsSales;
use App\latepaymentssalesinvoices;
use DB;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // sales_invoice
    
    public function confirmPayment(Request $request)
    {
         return "Confirm Payment";
        // supondo que a venda que desejamos ver seja o de id 
        $id = 11;
        $thisSales = sales::find($id);

        // recuperando os dados da venda, vamos criar uma tabela invoice onde ira armazenar todos os invoices
        // uma tabela que só linkara esse invoice atual com o id da venda em questão
                $createInvoice = new invoicetable();
                $createInvoice->sales_id =  $thisSales->id;
                $storeInvoice = $createInvoice->save();
                $Invoiceid =  $createInvoice->id;

                if($storeInvoice)
                {
                    return view('sections.sales.paymentsConfirmed', compact('thisSales', 'Invoiceid'));
                 
                }
                else{
                    return "no created";
                }


    }

    public function ExtraSales()
    {
        return view('sections.sales.extrasales.index');
    }


    public function storeExtraSales(Request $request)
    {


        if($request->Sales_Price == 'NaN' || $request->Sales_Price == null || $request->Sales_Price == '' ||
           $request->discount == 'NaN' || $request->discount == null || $request->discount == '' ||
           $request->Sales_PriceVat2 == 'NaN' || $request->Sales_PriceVat2 == null || $request->Sales_PriceVat2 == ''
        ){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }


        $description = $request->description;
        $sales_price = $request->Sales_Price;
        $sales_vat = ($sales_price * 1.20);
        $sales_subtotal = $request->Sales_Price; // subtotal é apenas o preço digitado no campo sales, sem vat ou discount
        $discount = $request->discount;
        $methodPayment = $request->methodPayment;
        $vatPrice = $request->Sales_PriceVat2 - $sales_price;

        // esse é o que vai para o campo sales_price é o total junto com vat e discount
        $Amounttotal =  $sales_vat - $discount;

        $createExtraSales = new sales();
        $createExtraSales->description = $description; // valor total da compra
        $createExtraSales->sales_price = $Amounttotal; // valor total da compra
        $createExtraSales->sales_subtotal = $sales_subtotal; // valor sem vat
        $createExtraSales->sales_discount = $discount; // valor do campo desconto
        $createExtraSales->sales_vat = $vatPrice; // valor apenas do vat
        $createExtraSales->methodPayment = $methodPayment; // metodo de pagamento 
        $storeProductsSales = $createExtraSales->save();
        $SalesId = $createExtraSales->id;
        $from = "extrasales";
        
        if($storeProductsSales){
            return redirect()
                        ->route('carrito.balance', ['SalesId' => $SalesId, $from])
                        ->with('success',  'The sales was successfull created' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }


        public function allsales($id = null)
        {   

            
            if($id == null){
               $allsales = allasales::where('status', 0)->get();

               $Nwaitingpayments = DB::table('allasales')
               ->where('status', 1)
               ->count('*');

               $thisCustomerStatus = 0;
               $thisCustomer = 0;
               $WKpaymentsStatus = 0;
               $NthisCustomerMachines = 0;
               $NthisCustomerWK = 0;
               $NbikesBought = 0;
               $NthisCustomerProductsBought = 0;
               $workorder_payments = 0;
               $Nappointments = 0;
            }
            else{
                 $allsales = allasales::where('chooseCustomer', $id)->get();
                $thisCustomer = Customer::find($id);
                $thisCustomerStatus = 1;
                // $allworkOrders = allworkorderinformations::all();
                $WKpaymentsStatus = 1;

                // COUNT TABLES
                $NthisCustomerMachines = DB::table('machinesallinfos')
                ->where('owner', $id)
                ->count('*');

                $NthisCustomerWK = DB::table('work_order')
                        ->where('customer', $id)
                        ->count('*');

                $NbikesBought = 0;

                $NthisCustomerProductsBought = DB::table('sales')
                        ->where('chooseCustomer', $id)
                        ->count('*');

                $Nappointments = DB::table('appointments')
                ->where('customerId', $id)
                ->count('*');      

                $Nwaitingpayments = DB::table('allasales')
                ->where('chooseCustomer', $id)
                ->where('status', 1)
                ->count('*');
            }

            $searchDataRange = false;
            $start = 0;
            $end = 0;   

            


            return view('sections.sales.productssales.index', compact('allsales','thisCustomerStatus', 'NbikesBought', 'NthisCustomerProductsBought',
            'thisCustomer', 'NthisCustomerMachines', 'NthisCustomerWK', 'Nappointments', 'searchDataRange', 'Nwaitingpayments','start', 'end'));
        }

        public function pendingSales()
        {   
            $allsales = allasales::where('status', 1)->get();
            return view('sections.sales.productssales.salesawaitingforpayments', compact('allsales'));
        }

        public function searchajax(Request $request)
        {

            $start = $request->dataComecoPadraoDateTime;
            $end = $request->dataFimPadraoDateTime;
            $id = null;

            if($start == null || $end == null)
            {
                return redirect()
                ->back()
                ->with('error',  'The date you entered for the start date is invalid' );
            }

            
             $allsales = allasales::select("*")
             ->whereDate('created_at', '>=', $start)
             ->whereDate('created_at', '<=', $end)
             ->get();

            $searchDataRange = true;

            $thisCustomerStatus = 0;
            $thisCustomer = 0;
            $WKpaymentsStatus = 0;
            $NthisCustomerMachines = 0;
            $NthisCustomerWK = 0;
            $NbikesBought = 0;
            $NthisCustomerProductsBought = 0;
            $workorder_payments = 0;
            $Nappointments = 0;

            
            return view('sections.sales.productssales.allsalessearchajax', compact('allsales','thisCustomerStatus', 'NbikesBought', 'NthisCustomerProductsBought',
            'thisCustomer', 'NthisCustomerMachines','NthisCustomerWK', 'Nappointments', 'searchDataRange', 'start', 'end'));
        }

        public function viewsales($id)
        {   
            // return redirect()->back();

            // return $vv =  latepaymentssalesinvoices::all();
            
            
            
            $allsales = allasales::find($id);
            $findLatePaymentSales = latepaymentssalesinvoices::where('salesReference', 'LIKE', $id)
            ->orderBy('created_at')
            ->get();

            $findLatestPaymentSales = latepaymentssalesinvoices::where('salesReference', 'LIKE', $id)
            ->orderBy('created_at', 'desc')
            ->first();

            $firstPayment = $allsales->created_at;
            $firstPayment = date('m/d/Y', strtotime($firstPayment));

            $Npayments = $allsales->Npayments;
            $paymentsOptions = $allsales->paymentsOptions;

            if($paymentsOptions == "PAYING WEEKLY")
            {   
                for($i=1; $i<$Npayments; $i++){
                    $start[] = date('d/m/Y', strtotime('+'.$i.'week', strtotime($firstPayment)));
                    $showDates = true;
                    $allpaydays = $start;

                }
            }
            else if($paymentsOptions == "PAYING MONTLHY") 
            {
                for($i=1; $i<$Npayments; $i++){
                    $start[] = date('d/m/Y', strtotime('+'.$i.'month', strtotime($firstPayment)));
                    $showDates = true;
                    $allpaydays = $start;

                }

            }
            else{
                $allpaydays = 0;
                $showDates = null;
            }

            


            $ProductsinTheInvoice = productsSales::where('salesId', 'LIKE', $id)->get();
            $firstPaymentDay = $allsales->created_at;
            $salesStatus = $allsales->status;

            //  return $start =date($firstPaymentDay, strtotime('-1 week')) ;
            //  $end =  date('Y-m-d');

            // return $allsales;

            return view('sections.sales.productssales.viewsales', 
            compact('allsales', 'id', 'ProductsinTheInvoice', 'salesStatus', 'allpaydays', 'showDates', 'findLatePaymentSales', 'findLatestPaymentSales'));
        }


        public function makeApayment(Request $request)
        {
            
            $thisSaleId =  $request->thisSaleId;
            $updateSales = sales::find($thisSaleId);

            $payToday =  $request->payToday;
            $sales_price = $updateSales->sales_price;
            $NpaymentsLeft = $updateSales->NpaymentsLeft;

            $new_sales_price = $sales_price  + $payToday;
            $newPaymentsLeft = $NpaymentsLeft - 1;

            if($newPaymentsLeft == 0){
                $newStatus = 0; // valor total da compra
            }
            else{
                $newStatus = 1; // valor total da compra
            }

            // return $a = [$newPaymentsLeft, $NpaymentsLeft];

            $new_sales_price = number_format($new_sales_price, 2, '.',',');
            $updateSales->sales_price = $new_sales_price; // valor total da compra
            $updateSales->NpaymentsLeft = $newPaymentsLeft; // metodo de pagamento 
            $updateSales->status = $newStatus; // metodo de pagamento 
            $storeProductsSales = $updateSales->save();


            // checking if we already have one invoices for this sale so we can check which n payments it will be
             $seePaymentsSales = latepaymentssalesinvoices::where('salesReference', 'LIKE', $thisSaleId)->latest()->limit(1)->get();

            if($seePaymentsSales == "[]")
            {
                $countPayment = 0;
                $invoiceNumber = 1;
            }
            else
            {   
                $thisPaymentSales = $seePaymentsSales[0];
                $countPayment = $thisPaymentSales->invoiceNumber;
                $invoiceNumber = $countPayment + 1;
            }

            // puxando da tabela sales onde ficam todas  as vendas ja realizadas
            $salesInfos = allasales::find($thisSaleId);
            $sales_price = $salesInfos->sales_price;
            $sales_subtotal  = $salesInfos->sales_subtotal;
            $sales_discount = $salesInfos->sales_discount;
            $sales_vat = $salesInfos->sales_vat;
            $totalSalesWithVat = $salesInfos->totalSalesWithVat;
            $totalSalesDiscount = $salesInfos->totalSalesDiscount;
            $methodPayment = $salesInfos->methodPayment;
            $description = $salesInfos->description;
            $customer = $salesInfos->chooseCustomer;
            $firstAmountPaid = $salesInfos->firstAmountPaid;
            $totalToBePaid = $salesInfos->totalToBePaid;
            $paymentsOptions = $salesInfos->paymentsOptions;
            $upfrontValue = $salesInfos->upfrontValue;
            $firstPaymentDate = $salesInfos->firstPaymentDate;
            $lastPaymentDate = $salesInfos->lastPaymentDate;
            $salesDate = $salesInfos->created_at;


            //adding na table que ficarão armazenados os invoices pagos depois
            $createlatepaymentssales = new latepaymentssalesinvoices();
            $createlatepaymentssales->salesReference = $thisSaleId; // valor total da compra
            $createlatepaymentssales->AmountPaid = $payToday; // valor total da compra
            $createlatepaymentssales->PaymentMethod = $updateSales->methodPayment; // valor sem vat
            $createlatepaymentssales->PaymentOption = $updateSales->paymentsOptions; // valor do campo desconto
            $createlatepaymentssales->customerReference = $updateSales->chooseCustomer; // valor apenas do vat
            $createlatepaymentssales->invoiceNumber = $invoiceNumber; 
            $createlatepaymentssales->sales_price = $sales_price; 
            $createlatepaymentssales->sales_subtotal = $sales_subtotal; 
            $createlatepaymentssales->sales_discount = $sales_discount; 
            $createlatepaymentssales->sales_vat = $sales_vat; 
            $createlatepaymentssales->salesDate = $salesDate; 
            $createlatepaymentssales->description = $description; 
            $createlatepaymentssales->firstAmountPaid = $firstAmountPaid; 
            $createlatepaymentssales->totalToBePaid = $totalToBePaid; 
            $createlatepaymentssales->status = $newStatus; 
            $createlatepaymentssales->upfrontValue = $upfrontValue; 
            $createlatepaymentssales->Npayments = $updateSales->Npayments; 
            $createlatepaymentssales->firstPaymentDate = $firstPaymentDate; 
            $createlatepaymentssales->lastPaymentDate = $lastPaymentDate; 
            $createlatepaymentssales->NpaymentsLeft = $newPaymentsLeft; 
            $createlatepaymentssales->payToday = $payToday; 
            $Updatecreatelatepaymentssales = $createlatepaymentssales->save();


            

                   
        if($Updatecreatelatepaymentssales){
            return redirect()
                        ->route('sales.viewsales', ['id' => $thisSaleId])
                        ->with('success',  'The sales was successfull' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }


        public function latepaymentsinvoices ($id, $Npayments = null, $from = null)
        {   
            

            $findLatePaymentSales = latepaymentssalesinvoices::find($id);

            $salesId = $findLatePaymentSales->salesReference;

            // products in this sale
            $ProductsInfos2 = productsSales::where('salesId', 'LIKE', "$salesId")->get();

            // return $a = [$salesId, $Npayments];

            // puxando da tabela sales onde ficam todas  as vendas ja realizadas
            $salesInfos = latepaymentssalesinvoices::where('salesReference', 'LIKE', $salesId)->where('invoiceNumber', 'LIKE', $Npayments)->get()[0];
            $sales_price = $salesInfos->sales_price;
            $sales_subtotal  = $salesInfos->sales_subtotal;
            $sales_discount = $salesInfos->sales_discount;
            $sales_vat = $salesInfos->sales_vat;
            $totalSalesWithVat = $salesInfos->totalSalesWithVat;
            $totalSalesDiscount = $salesInfos->totalSalesDiscount;
            $methodPayment = $salesInfos->methodPayment;
            $description = $salesInfos->description;
            $customer = $salesInfos->chooseCustomer;
            $firstAmountPaid = $salesInfos->firstAmountPaid;
            $totalToBePaid = $salesInfos->totalToBePaid;
            $paymentsOptions = $salesInfos->PaymentOption;
            $upfrontValue = $salesInfos->upfrontValue;
            $upfrontValue = $salesInfos->upfrontValue;
            $created_at = $salesInfos->created_at;
            $salesDate = $salesInfos->salesDate;
            
            $salesInfos->Npayments;


            // //adding na table que ficarão armazenados os invoices pagos depois
            // $findLatePaymentSales = latepaymentssalesinvoices::find($id);
            // $createlatepaymentssales->salesReference = $thisSaleId; // valor total da compra
            // $createlatepaymentssales->AmountPaid = $payToday; // valor total da compra
            // $createlatepaymentssales->PaymentMethod = $updateSales->methodPayment; // valor sem vat
            // $createlatepaymentssales->PaymentOption = $updateSales->paymentsOptions; // valor do campo desconto
            // $createlatepaymentssales->customerReference = $updateSales->chooseCustomer; // valor apenas do vat
            // $createlatepaymentssales->invoiceNumber = $invoiceNumber; // valor apenas do vat
            // $createlatepaymentssales->sales_price = $sales_price; // valor apenas do vat
            // $createlatepaymentssales->sales_subtotal = $sales_subtotal; // valor apenas do vat
            // $createlatepaymentssales->sales_discount = $sales_discount; // valor apenas do vat
            // $createlatepaymentssales->sales_vat = $sales_vat; // valor apenas do vat
            // $createlatepaymentssales->description = $description; // valor apenas do vat
            // $createlatepaymentssales->firstAmountPaid = $firstAmountPaid; // valor apenas do vat
            // $createlatepaymentssales->totalToBePaid = $totalToBePaid; // valor apenas do vat
            // $createlatepaymentssales->totalToBePaid = $totalToBePaid; // valor apenas do vat
            // $Updatecreatelatepaymentssales = $createlatepaymentssales->save();

            if($salesInfos->Npayments == $salesInfos->NpaymentsLeft){
                $Npayments = $salesInfos->Npayments - 1;
                $NpaymentsLeft = $salesInfos->NpaymentsLeft - 1;
            }
            else {
                $Npayments = $salesInfos->Npayments;
                $NpaymentsLeft = $salesInfos->NpaymentsLeft;

            }

            

            

            $thisCustomer  = Customer::find($customer);
           
            $typesales = 0;
    
            $sales_price = number_format($sales_price, 2, '.',',');
            $sales_subtotal = number_format($sales_subtotal, 2, '.',',');
            $sales_discount = number_format($sales_discount, 2, '.',',');
            $sales_vat = number_format($sales_vat, 2, '.',',');
            $totalSalesWithVat = number_format($totalSalesWithVat, 2, '.',',');
            $totalSalesDiscount = number_format($totalSalesDiscount, 2, '.',',');
            // $firstAmountPaid = number_format($firstAmountPaid, 2, '.',',');
            // $totalToBePaid = number_format($totalToBePaid, 2, '.',',');
            // diferenciando sales normais de extrasales
    
            if($description == 'standard'){
                $typesales = 0;
            }
            else{
                $typesales = 1 ;
            }

            // descobrindo as datas dos pagamentos
    
        return view('sections.sales.invoice.latepaymentsinvoices', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount', 'thisCustomer',
                    'sales_vat', 'methodPayment', 'sales_subtotal', 'upfrontValue', 'Npayments', 'NpaymentsLeft', 'created_at', 'salesDate',
                     'typesales', 'description', 'from', 'paymentsOptions', 'firstAmountPaid', 'totalToBePaid'));
        }

}
 