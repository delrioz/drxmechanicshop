<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\allasales;
use App\sales_invoice;
use App\allinfosproductssales;
use App\Customer;
use App\productsSales;

class SalesInvoiceController extends Controller
{
    public function index($id, $from = null)
    {

        $salesId = $id;

        // products in this sale
        $ProductsInfos2 = productsSales::where('salesId', 'LIKE', $salesId)->get();

        // puxando da tabela sales onde ficam todas  as vendas ja realizadas
        $salesInfos = allasales::find($salesId);

        if($salesInfos == "[]" || $salesInfos == null ){
            return redirect()
            ->back()
            ->with('error');
        }

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
        // diferenciando sales normais de extrasales

        if($description == 'standard'){
            $typesales = 0;
        }
        else{
            $typesales = 1 ;
        }

        $NpaymentsLeft = $salesInfos->NpaymentsLeft;
        $Npayments = $salesInfos->Npayments;

        $upfrontValue = number_format($salesInfos->upfrontValue , 2, '.',',');

        $salesDate = date('d/m/Y', strtotime($salesInfos->created_at));
        
        
        // descobrindo as datas dos pagamentos

        return view('sections.carrito.invoice', compact('salesId', 'ProductsInfos2', 'salesInfos', 'sales_price', 'sales_discount', 'thisCustomer',
                'msgThisCustomer', 'salesDate', 'upfrontValue', 'Npayments', 'NpaymentsLeft', 'sales_vat', 'methodPayment', 'sales_subtotal', 'typesales', 'description', 'from', 'paymentsOptions', 'firstAmountPaid', 'totalToBePaid'));
        
    }

    public function destroy($id)
    {
        
        {$products_sales = productsSales::where('salesId', 'LIKE', $id)->delete();}
        $deletesales = sales::find($id)->delete();
        {$delete_sales_invoice = sales_invoice::where('salesReference', 'LIKE', $id)->delete();}

        // $deletesales2 = products_machines::where('product_id', 'LIKE', "%{$id}%")->delete();

        if($deletesales){
            return redirect()
                    ->back()
                    ->with('success',  'The sales was successful removed' );
            }


            else
            {
                $response='';
                return redirect()
                            ->back()
                            ->with('error');
             }

    }



}
