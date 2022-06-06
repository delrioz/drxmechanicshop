<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use App\Customer;
use App\Machine;
use App\viewProductsinMachines;
use DB;
use App\ShowMachinesByProducts;
use App\ShowProductsByMachines;
use App\allworkorderinformations;
use App\workorder_payments;
use App\products_on_workorders;
use App\Product;
use App\showonoverviewworkorders;
use App\workorder_invoice;
use Redirect;
use App\overviewbetweenworkorderandproductsqts;
use App\totalprodsSelectedWK;
use App\products_machines_workorders;
use App\quotepreviewinvoice;
use App\extraitems;
use App\totalextraitemsworkOrderId;

class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processing($id, $from = null)
    {

        
        $findWK = workorder::find($id);
        $wkID = $findWK->machine;



        $allworkOrders = allworkorderinformations::find($id);
        $ExtraItems = extraitems::where('workOrderId', 'LIKE', $id)->get();


        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
        // $ProductsInfo = ShowProductsByMachines::whereRaw('workOrderReference = ' . $id)->get();
        // $ProductsInfo = overviewbetweenworkorderandproductsqts ::whereRaw('pmwWorkOrderReference = ' . $id)->get();


        $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();



        // $machineId = Machine::find($id);
        // $ownerId = $machineId->owner;
        // $machineswithowner = machineswithowner::where('idCustomer', 'LIKE', "%{$ownerId}%")->first();
        // $nameOwner = $machineswithowner->nameCustomer;

        //puxando dados da quote relacionada à ela


        $allcustomers = Customer::all();
        $allmachines = Machine::all();

        // see if there is any work order invoice already created

        $findWKInvoice = workorder_invoice::where('workOrderReference', $id)->get();
        
        if($findWKInvoice == "[]"){
            $paymentDone = false;
        }
        else{
            $paymentDone = true;
        }
        
        
        return view('sections.payments.processing', compact('allworkOrders','allcustomers', 'allmachines','id', 'ProductsInfo',
          'from', 'ExtraItems', 'findWKInvoice', 'paymentDone'));

    }

    public function confirmPayment(Request $request)
    {


        // pegando nome dos produtos utilizados nessa ordem de serviço e suas quantidades
         $productName =  $request->productName;
         $productQuantity =  $request->quantity;

        if($productName == '' || $productQuantity == '' ){
            return redirect()
            ->back()
            ->with('status', 'There is no product or valid quantity in this work order');
        }

        //  FAZENDO O UPDATE NO STATUS DA WORK ORDER, ATUALIZANDO TAMBEM OS OUTROS VALORES E REALIZANDO A INSERÇÃO NA TABELA WORKORDER_PAYMENTS
         $findWorkOrder = WorkOrder::find($request->id);
        if($findWorkOrder) {
            $findWorkOrder->title = $request->input('title');
            $findWorkOrder->customer_report = $request->input('customer_report');
            $findWorkOrder->first_observations = $request->input('first_observations');
            $findWorkOrder->last_observations = $request->input('last_observations');
            $findWorkOrder->customer = $request->input('customer');
            $findWorkOrder->machine = $request->input('machine');
            $findWorkOrder->status = 1;
            $findWorkOrder->typeofpayment = $request->input('typeofpayment');
            $findWorkOrder->price = $request->input('amount');
            $findWorkOrder->discount = $request->input('discount');
            $findWorkOrder->worklabor = $request->input('worklabor');
            $updatemachines = $findWorkOrder->save();
        }



        if($updatemachines){

            $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();
            $amountProducts = $findthisoverview->totalProductsonThisWk;
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
             $amount = (($findWorkOrder->price) + $amountProducts) ; // AMOUNT É O SUBTOTAL
             $amountwithoutproducts = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL

             $machineId = $findWorkOrder->machine;
             $typeofpayment = $findWorkOrder->typeofpayment;
             $discount = $findWorkOrder->discount;
             $workOrderReference = $findWorkOrder->id;
             $worklabor = $findWorkOrder->worklabor;

             $total = (($amount - $discount) +$worklabor);
             $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
            //  $subtotal = (($amount - $discount) +$worklabor);

             // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso
             $totalWithVAT = ($totalwithoutproducts * 0.20) + $total;

             // vat total *tirando os produtos que ja vieram com vat *
             $vat = ($totalwithoutproducts * 0.20);

            // REMOVER PRODUTOS DO BANCO QUANDO PRESENTES NESSA WORK ORDER
             $findProductsOnThisWK = products_machines_workorders::where('workOrderReference', 'LIKE', $request->id)->get();

             foreach($findProductsOnThisWK as $item){
                $prodctsFound =  $item->product_id;
                 $productsQuantity =  $item->productQuantity;

                $achadoProduct = $findProduct = Product::find($prodctsFound)->first();
                $cantidad = 155;

                if($achadoProduct){
                    // decrementando a utilizada vendida da tabela products
                     $prod = Product::find($prodctsFound);
                    // return $prod->quantity;
                    $prod->quantity = $prod->quantity-=$productsQuantity;
                     $updateProd = $prod->save();
                }

            }

            $ActualDate = date('d/m/y');
            // workorder_payments;
            // $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT, vat, amountProducts, amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts, $findWorkOrder->price, $ActualDate]);

            $newWorkOrderPayments = new workorder_payments;
            $newWorkOrderPayments->amount = $amount;
            $newWorkOrderPayments->machineId =$machineId;
            $newWorkOrderPayments->typeofpayment = $typeofpayment;
            $newWorkOrderPayments->discount = $discount;
            $newWorkOrderPayments->workOrderReference = $workOrderReference;
            $newWorkOrderPayments->worklabor = $worklabor;
            $newWorkOrderPayments->total = $total;
            $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
            $newWorkOrderPayments->vat = $vat;
            $newWorkOrderPayments->amountProducts = $amountProducts;
            $newWorkOrderPayments->amoutwkwithoutprods = $findWorkOrder->price;
            $createInvoice = $newWorkOrderPayments->save();

        }

        if($newWorkOrderPayments){
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
             $machineId = $findWorkOrder->machine;
             $typeofpayment = $findWorkOrder->typeofpayment;
             $workOrderReference = $findWorkOrder->id;
             $quoteReference = $findWorkOrder->quoteReference;
             $total = (($amount - $discount) +$worklabor);
             $totalWithVAT = ($total * 0.20) + $total;

            // workorder_payments;
            // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                $newInvoice = new workorder_invoice;
                $newInvoice->machineId = $machineId;
                $newInvoice->quoteReference =$quoteReference;
                $newInvoice->workOrderReference = $workOrderReference;
                $createInvoice = $newInvoice->save();
        }

            $id =  $request->id;
            $Machine_Id =  $request->machine;
            $typeofpayment =  $request->typeofpayment;
            $nameCustomer =  $request->customer;
            $dataConfirmPay = $request;
            $product = $dataConfirmPay->title;
            $customer_report = $dataConfirmPay->customer_report;
            $first_observations = $dataConfirmPay->first_observations;
            $last_observations = $dataConfirmPay->last_observations;
            $newInvoiceId = $newInvoice->id;



            return redirect()->route('pays.gerarinvoice', ['id' => $id, 'machine' => $Machine_Id, 'typeofpayment' => $typeofpayment, 'nameCustomer' => $nameCustomer,
            'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report, 'first_observations' => $first_observations,
            'last_observations' => $last_observations,  'newInvoiceId' =>$newInvoiceId, 'amountProducts' => $amountProducts]);



    }


    public function confirmPaymentAjax(Request $request)
    {


        if($request->worklabor == 'NaN' || $request->worklabor == null || $request->worklabor == '' ||
        $request->discount == 'NaN' || $request->discount == null || $request->discount == ''

        ){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }


        $title =  $request->title;
        $last_observations =  $request->last_observations;
        $workOrderId = $request->id;

        // pegando nome dos produtos utilizados nessa ordem de serviço e suas quantidades
         $productName =  $request->productName;
         $productQuantity =  $request->productQuantity;

        if(isset($productName)){
            if($productName == '' || $productQuantity == '' ){
                // return redirect()
                // ->back()
                // ->with('status', 'There is no product or valid quantity in this work order');
                return "aqui no product";
            }
        }




        //  FAZENDO O UPDATE NO STATUS DA WORK ORDER, ATUALIZANDO TAMBEM OS OUTROS VALORES E REALIZANDO A INSERÇÃO NA TABELA WORKORDER_PAYMENTS
         $findWorkOrder = WorkOrder::find($request->id);

                if($findWorkOrder) {
                    $findWorkOrder->status = 1;
                    $updatemachines = $findWorkOrder->save();
                }

                //  LOGICA CASO SO TENHA EXTRA SALES

                if($productName == '' || $productQuantity == '' )
                {
                        $findDatasonRelationTableExtraItems = extraitems::where('workOrderId', 'LIKE', $request->id)->first();

                        if($findDatasonRelationTableExtraItems != null || $findDatasonRelationTableExtraItems != "")
                        {
                            //infos da pagina processing
                                $workOrderReference = $request->id;
                                $machineId = $findWorkOrder->machine;
                                $typeofpayment = $request->typeofpayment;
                                $discount = $request->discount;
                                $worklabor = $request->worklabor;


                                // total de produtos extras
                                $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
                                $totalExtraItemsWithouVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;


                                // $amountProducts = 0;
                                // //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                                // $amount = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                                // $amountwithoutproducts = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                                // $a = [$worklabor, $discount, $typeofpayment, $machineId, $workOrderReference];

                                    $SubTotal = $worklabor + $totalExtraItemsWithouVAT;
                                    $vat = ($SubTotal * 0.20);
                                    $subTotalWithVAT = ($SubTotal  + $vat);
                                    $total = $SubTotal - $discount; // total without vat
                                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                                // $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
                                //  $subtotal = (($amount - $discount) +$worklabor);

                                // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso

                                // vat total *tirando os produtos que ja vieram com vat *

                                // na hora de fechar a ordem caso tenha nenhum produto cadastrado
                                $newWorkOrderPayments = new workorder_payments;
                                $newWorkOrderPayments->amount = $SubTotal;
                                $newWorkOrderPayments->machineId =$machineId;
                                $newWorkOrderPayments->typeofpayment = $typeofpayment;
                                $newWorkOrderPayments->discount = $discount;
                                $newWorkOrderPayments->workOrderReference = $workOrderReference;
                                $newWorkOrderPayments->worklabor = $worklabor;
                                $newWorkOrderPayments->total = $total;
                                $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                                $newWorkOrderPayments->vat = $vat;
                                $newWorkOrderPayments->amountProducts = 0; // zero porque neste caso, nao tem
                                $newWorkOrderPayments->amoutwkwithoutprods = $totalWithVAT; // cotinua o mesmo, porque nesse caso, nao tem
                                $createInvoice = $newWorkOrderPayments->save();


                            if($newWorkOrderPayments){
                                //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                                $typeofpayment = $findWorkOrder->typeofpayment;
                                $quoteReference = $findWorkOrder->quoteReference;

                                // workorder_payments;
                                // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                                    $newInvoice = new workorder_invoice;
                                    $newInvoice->machineId = $machineId;
                                    $newInvoice->quoteReference =$quoteReference;
                                    $newInvoice->workOrderReference = $workOrderReference;
                                    $createInvoice = $newInvoice->save();

                            }


                            // atualizando valores do titulo e last observations na tabela work orders
                            if($createInvoice){
                                //att work order
                                $newWk =  workOrder::find($workOrderId);
                                $newWk->title = $title;
                                $newWk->last_observations =$last_observations;
                                $updateworkOrder = $newWk->save();
                            }


                                $id =  $request->id;
                                $Machine_Id =  $request->machine;
                                $typeofpayment =  $request->typeofpayment;
                                $nameCustomer =  $request->customer;
                                $dataConfirmPay = $request;
                                $product = $request->title;
                                $customer_report = $dataConfirmPay->customer_report;
                                $first_observations = $dataConfirmPay->first_observations;
                                // $last_observations = $dataConfirmPay->last_observations;
                                $newInvoiceId = $newInvoice->id;

                                // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                                return $newInvoiceId;
                        }

                        // FIM LOGICA CASO SO TENHA EXTRA SALES

                        else
                        {

                            //infos da pagina processing
                            $workOrderReference = $request->id;
                            $machineId = $findWorkOrder->machine;
                            $typeofpayment = $request->typeofpayment;
                            $discount = $request->discount;
                            $worklabor = $request->worklabor;


                            // $amountProducts = 0;
                            // //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                            // $amount = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                            // $amountwithoutproducts = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                            // $a = [$worklabor, $discount, $typeofpayment, $machineId, $workOrderReference];

                                $SubTotal = $worklabor;
                                $vat = ($SubTotal * 0.20);
                                $subTotalWithVAT = ($SubTotal  + $vat);
                                $total = $SubTotal - $discount; // total without vat
                                $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                            // $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
                            //  $subtotal = (($amount - $discount) +$worklabor);

                            // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso

                            // vat total *tirando os produtos que ja vieram com vat *


                            // na hora de fechar a ordem caso tenha nenhum produto cadastrado
                            $newWorkOrderPayments = new workorder_payments;
                            $newWorkOrderPayments->amount = $SubTotal;
                            $newWorkOrderPayments->machineId =$machineId;
                            $newWorkOrderPayments->typeofpayment = $typeofpayment;
                            $newWorkOrderPayments->discount = $discount;
                            $newWorkOrderPayments->workOrderReference = $workOrderReference;
                            $newWorkOrderPayments->worklabor = $worklabor;
                            $newWorkOrderPayments->total = $total;
                            $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                            $newWorkOrderPayments->vat = $vat;
                            $newWorkOrderPayments->amountProducts = 0; // zero porque neste caso, nao tem
                            $newWorkOrderPayments->amoutwkwithoutprods = $totalWithVAT; // cotinua o mesmo, porque nesse caso, nao tem
                            $createInvoice = $newWorkOrderPayments->save();



                        if($newWorkOrderPayments){
                            $workOrderReference = $findWorkOrder->id;
                            $quoteReference = $findWorkOrder->quoteReference;

                            // workorder_payments;
                            // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                                $newInvoice = new workorder_invoice;
                                $newInvoice->machineId = $machineId;
                                $newInvoice->quoteReference =$quoteReference;
                                $newInvoice->workOrderReference = $workOrderReference;
                                $createInvoice = $newInvoice->save();

                        }


                        // atualizando valores do titulo e last observations na tabela work orders
                        if($createInvoice){
                            //att work order
                            $newWk =  workOrder::find($workOrderId);
                            $newWk->title = $title;
                            $newWk->last_observations =$last_observations;
                            $updateworkOrder = $newWk->save();
                        }


                            $id =  $request->id;
                            $Machine_Id =  $request->machine;
                            $typeofpayment =  $request->typeofpayment;
                            $nameCustomer =  $request->customer;
                            $dataConfirmPay = $request;
                            $product = $request->title;
                            $customer_report = $dataConfirmPay->customer_report;
                            $first_observations = $dataConfirmPay->first_observations;
                            // $last_observations = $dataConfirmPay->last_observations;
                            $newInvoiceId = $newInvoice->id;


                            // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                            return $newInvoiceId;
                        }
                }
            // FIM DA LOGICA CASO N TENHA PRODDUTOS, EXTRA SALES

        if($updatemachines){
            // VERIFICANDO SE VAO SER PRODUTOS COM EXTRA PRODUTOS OU SOMENTE PRODUTOS SOZINHOS
            $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
            if($findthisoverviewExtraItems == null){

                // only products
                    $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();

                //infos da pagina processing
                    $workOrderReference = $request->id;
                    $machineId = $findWorkOrder->machine;
                    $typeofpayment = $request->typeofpayment;
                    $discount = $request->discount;
                    $worklabor = $request->worklabor;

                    // Amount total dos produtos (PREÇOS SEM VAT)
                    $amountProducts = $findthisoverview->totalProductsonThisWk;

                    $SubTotal = $worklabor + $amountProducts; // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                    $vat = ($SubTotal * 0.20);
                    $subTotalWithVAT = ($SubTotal  + $vat);
                    $total = $SubTotal - $discount; // total without vat
                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                    $amoutwkwithoutprodscount = (($worklabor * 1.20) - $discount);
                    $request->worklabor == 0 ? $amoutwkwithoutprods =  0 : $amoutwkwithoutprods = $amoutwkwithoutprodscount;


                    // REMOVER PRODUTOS UTILIZADOS NESSA WORK ORDER
                    $findProductsOnThisWK = products_machines_workorders::where('workOrderReference', 'LIKE', $request->id)->get();


                    // da tabela produtos
                    foreach($findProductsOnThisWK as $item){
                        $prodctsFound =  $item->product_id;
                        $productsQuantity =  $item->productQuantity;

                        $achadoProduct = $findProduct = Product::find($prodctsFound)->first();
                        $cantidad = 155;

                        if($achadoProduct){
                            // decrementando a utilizada vendida da tabela products
                            $prod = Product::find($prodctsFound);
                            // return $prod->quantity;
                            $prod->quantity = $prod->quantity-=$productsQuantity;
                            $updateProd = $prod->save();
                        }

                    }
                    $ActualDate = date('d/m/y');

                    // workorder_payments;
                    // $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT, vat, amountProducts, amoutwkwithoutprods ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', []);
                    // $amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts, $findWorkOrder->price

                    $newWorkOrderPayments = new workorder_payments;
                    $newWorkOrderPayments->amount = $SubTotal;
                    $newWorkOrderPayments->machineId =$machineId;
                    $newWorkOrderPayments->typeofpayment = $typeofpayment;
                    $newWorkOrderPayments->discount = $discount;
                    $newWorkOrderPayments->workOrderReference = $workOrderReference;
                    $newWorkOrderPayments->worklabor = $worklabor;
                    $newWorkOrderPayments->total = $total;
                    $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                    $newWorkOrderPayments->vat = $vat;
                    $newWorkOrderPayments->amountProducts = $amountProducts;
                    $newWorkOrderPayments->amoutwkwithoutprods = $amoutwkwithoutprods;
                    $createInvoice = $newWorkOrderPayments->save();



                if($newWorkOrderPayments){
                    $workOrderReference = $findWorkOrder->id;
                    $quoteReference = $findWorkOrder->quoteReference;

                    // workorder_payments;
                    // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                        $newInvoice = new workorder_invoice;
                        $newInvoice->machineId = $machineId;
                        $newInvoice->quoteReference =$quoteReference;
                        $newInvoice->workOrderReference = $workOrderReference;
                        $createInvoice = $newInvoice->save();
                }

                // atualizando valores do titulo e last observations na tabela work orders
                if($createInvoice){
                    //att work order
                    $newWk =  workOrder::find($workOrderId);
                    $newWk->title = $title;
                    $newWk->last_observations =$last_observations;
                    $updateworkOrder = $newWk->save();
                }


                    $id =  $request->id;
                    $Machine_Id =  $request->machine;
                    $typeofpayment =  $request->typeofpayment;
                    $nameCustomer =  $request->customer;
                    $dataConfirmPay = $request;
                    $product = $request->title;
                    $customer_report = $dataConfirmPay->customer_report;
                    $first_observations = $dataConfirmPay->first_observations;
                    // $last_observations = $dataConfirmPay->last_observations;
                    $newInvoiceId = $newInvoice->id;


                    // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                    return $newInvoiceId;


            }

            else{
                    // products and extra items

                    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
                    $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;


                // only products
                    $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();


                //infos da pagina processing
                    $workOrderReference = $request->id;
                    $machineId = $findWorkOrder->machine;
                    $typeofpayment = $request->typeofpayment;
                    $discount = $request->discount;
                    $worklabor = $request->worklabor;

                    // Amount total dos produtos (PREÇOS SEM VAT)
                    $amountProducts = $findthisoverview->totalProductsonThisWk;

                    $SubTotal = ($worklabor + $amountProducts + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                    $vat = ($SubTotal * 0.20);
                    $subTotalWithVAT = ($SubTotal  + $vat);
                    $total = $SubTotal - $discount; // total without vat
                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
                    $amoutwkwithoutprods = ((($worklabor + $totalExtraItemsWithoutVAT)  * 1.20) - $discount);


                    // REMOVER PRODUTOS UTILIZADOS NESSA WORK ORDER
                    $findProductsOnThisWK = products_machines_workorders::where('workOrderReference', 'LIKE', $request->id)->get();


                    // da tabela produtos
                    foreach($findProductsOnThisWK as $item){
                        $prodctsFound =  $item->product_id;
                        $productsQuantity =  $item->productQuantity;

                        $achadoProduct = $findProduct = Product::find($prodctsFound)->first();
                        $cantidad = 155;

                        if($achadoProduct){
                            // decrementando a utilizada vendida da tabela products
                            $prod = Product::find($prodctsFound);
                            // return $prod->quantity;
                            $prod->quantity = $prod->quantity-=$productsQuantity;
                            $updateProd = $prod->save();
                        }

                    }
                    $ActualDate = date('d/m/y');



                    // workorder_payments;
                    // $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT, vat, amountProducts, amoutwkwithoutprods ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', []);
                    // $amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts, $findWorkOrder->price

                    $newWorkOrderPayments = new workorder_payments;
                    $newWorkOrderPayments->amount = $SubTotal;
                    $newWorkOrderPayments->machineId =$machineId;
                    $newWorkOrderPayments->typeofpayment = $typeofpayment;
                    $newWorkOrderPayments->discount = $discount;
                    $newWorkOrderPayments->workOrderReference = $workOrderReference;
                    $newWorkOrderPayments->worklabor = $worklabor;
                    $newWorkOrderPayments->total = $total;
                    $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                    $newWorkOrderPayments->vat = $vat;
                    $newWorkOrderPayments->amountProducts = $amountProducts;
                    $newWorkOrderPayments->amoutwkwithoutprods = $amoutwkwithoutprods;
                    $createInvoice = $newWorkOrderPayments->save();



                if($newWorkOrderPayments){
                    $workOrderReference = $findWorkOrder->id;
                    $quoteReference = $findWorkOrder->quoteReference;

                    // workorder_payments;
                    // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                        $newInvoice = new workorder_invoice;
                        $newInvoice->machineId = $machineId;
                        $newInvoice->quoteReference =$quoteReference;
                        $newInvoice->workOrderReference = $workOrderReference;
                        $createInvoice = $newInvoice->save();
                }

                // atualizando valores do titulo e last observations na tabela work orders
                if($createInvoice){
                    //att work order
                    $newWk =  workOrder::find($workOrderId);
                    $newWk->title = $title;
                    $newWk->last_observations =$last_observations;
                    $updateworkOrder = $newWk->save();
                }


                    $id =  $request->id;
                    $Machine_Id =  $request->machine;
                    $typeofpayment =  $request->typeofpayment;
                    $nameCustomer =  $request->customer;
                    $dataConfirmPay = $request;
                    $product = $request->title;
                    $customer_report = $dataConfirmPay->customer_report;
                    $first_observations = $dataConfirmPay->first_observations;
                    // $last_observations = $dataConfirmPay->last_observations;
                    $newInvoiceId = $newInvoice->id;


                    // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                    return $newInvoiceId;

            }
        }


            // return redirect()->route('pays.gerarinvoice', ['id' => $id, 'machine' => $Machine_Id, 'typeofpayment' => $typeofpayment, 'nameCustomer' => $nameCustomer,
            // 'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report, 'first_observations' => $first_observations,
            // 'last_observations' => $last_observations,  'newInvoiceId' =>$newInvoiceId, 'amountProducts' => $amountProducts]);

    }

    public function waitingforcollection(Request $request)
    {
        if($request->worklabor == 'NaN' || $request->worklabor == null || $request->worklabor == '' ||
        $request->discount == 'NaN' || $request->discount == null || $request->discount == ''

        ){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }


        $title =  $request->title;
        $last_observations =  $request->last_observations;
        $workOrderId = $request->id;

        // pegando nome dos produtos utilizados nessa ordem de serviço e suas quantidades
         $productName =  $request->productName;
         $productQuantity =  $request->productQuantity;

        if(isset($productName)){
            if($productName == '' || $productQuantity == '' ){
                // return redirect()
                // ->back()
                // ->with('status', 'There is no product or valid quantity in this work order');
                return "aqui no product";
            }
        }



        //  FAZENDO O UPDATE NO STATUS DA WORK ORDER, ATUALIZANDO TAMBEM OS OUTROS VALORES E REALIZANDO A INSERÇÃO NA TABELA WORKORDER_PAYMENTS
         $findWorkOrder = WorkOrder::find($request->id);

                if($findWorkOrder) {
                    $findWorkOrder->status = 2;
                    $updatemachines = $findWorkOrder->save();
                }

                //  LOGICA CASO SO TENHA EXTRA SALES

                if($productName == '' || $productQuantity == '' )
                {
                        $findDatasonRelationTableExtraItems = extraitems::where('workOrderId', 'LIKE', $request->id)->first();

                        if($findDatasonRelationTableExtraItems != null || $findDatasonRelationTableExtraItems != "")
                        {
                            //infos da pagina processing
                                $workOrderReference = $request->id;
                                $machineId = $findWorkOrder->machine;
                                $typeofpayment = $request->typeofpayment;
                                $discount = $request->discount;
                                $worklabor = $request->worklabor;


                                // total de produtos extras
                                $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
                                $totalExtraItemsWithouVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;


                                // $amountProducts = 0;
                                // //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                                // $amount = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                                // $amountwithoutproducts = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                                // $a = [$worklabor, $discount, $typeofpayment, $machineId, $workOrderReference];

                                    $SubTotal = $worklabor + $totalExtraItemsWithouVAT;
                                    $vat = ($SubTotal * 0.20);
                                    $subTotalWithVAT = ($SubTotal  + $vat);
                                    $total = $SubTotal - $discount; // total without vat
                                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                                // $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
                                //  $subtotal = (($amount - $discount) +$worklabor);

                                // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso

                                // vat total *tirando os produtos que ja vieram com vat *

                                // na hora de fechar a ordem caso tenha nenhum produto cadastrado
                                $newWorkOrderPayments = new workorder_payments;
                                $newWorkOrderPayments->amount = $SubTotal;
                                $newWorkOrderPayments->machineId =$machineId;
                                $newWorkOrderPayments->typeofpayment = $typeofpayment;
                                $newWorkOrderPayments->discount = $discount;
                                $newWorkOrderPayments->workOrderReference = $workOrderReference;
                                $newWorkOrderPayments->worklabor = $worklabor;
                                $newWorkOrderPayments->total = $total;
                                $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                                $newWorkOrderPayments->vat = $vat;
                                $newWorkOrderPayments->amountProducts = 0; // zero porque neste caso, nao tem
                                $newWorkOrderPayments->amoutwkwithoutprods = $totalWithVAT; // cotinua o mesmo, porque nesse caso, nao tem
                                $createInvoice = $newWorkOrderPayments->save();


                            if($newWorkOrderPayments){
                                //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                                $typeofpayment = $findWorkOrder->typeofpayment;
                                $quoteReference = $findWorkOrder->quoteReference;

                                // workorder_payments;
                                // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                                    $newInvoice = new workorder_invoice;
                                    $newInvoice->machineId = $machineId;
                                    $newInvoice->quoteReference =$quoteReference;
                                    $newInvoice->workOrderReference = $workOrderReference;
                                    $createInvoice = $newInvoice->save();

                            }


                            // atualizando valores do titulo e last observations na tabela work orders
                            if($createInvoice){
                                //att work order
                                $newWk =  workOrder::find($workOrderId);
                                $newWk->title = $title;
                                $newWk->last_observations =$last_observations;
                                $updateworkOrder = $newWk->save();
                            }


                                $id =  $request->id;
                                $Machine_Id =  $request->machine;
                                $typeofpayment =  $request->typeofpayment;
                                $nameCustomer =  $request->customer;
                                $dataConfirmPay = $request;
                                $product = $request->title;
                                $customer_report = $dataConfirmPay->customer_report;
                                $first_observations = $dataConfirmPay->first_observations;
                                // $last_observations = $dataConfirmPay->last_observations;
                                $newInvoiceId = $newInvoice->id;

                                // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                                return $newInvoiceId;
                        }

                        // FIM LOGICA CASO SO TENHA EXTRA SALES

                        else
                        {

                            //infos da pagina processing
                            $workOrderReference = $request->id;
                            $machineId = $findWorkOrder->machine;
                            $typeofpayment = $request->typeofpayment;
                            $discount = $request->discount;
                            $worklabor = $request->worklabor;


                            // $amountProducts = 0;
                            // //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
                            // $amount = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                            // $amountwithoutproducts = (($findWorkOrder->price)) ; // AMOUNT É O SUBTOTAL
                            // $a = [$worklabor, $discount, $typeofpayment, $machineId, $workOrderReference];

                                $SubTotal = $worklabor;
                                $vat = ($SubTotal * 0.20);
                                $subTotalWithVAT = ($SubTotal  + $vat);
                                $total = $SubTotal - $discount; // total without vat
                                $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                            // $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
                            //  $subtotal = (($amount - $discount) +$worklabor);

                            // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso

                            // vat total *tirando os produtos que ja vieram com vat *


                            // na hora de fechar a ordem caso tenha nenhum produto cadastrado
                            $newWorkOrderPayments = new workorder_payments;
                            $newWorkOrderPayments->amount = $SubTotal;
                            $newWorkOrderPayments->machineId =$machineId;
                            $newWorkOrderPayments->typeofpayment = $typeofpayment;
                            $newWorkOrderPayments->discount = $discount;
                            $newWorkOrderPayments->workOrderReference = $workOrderReference;
                            $newWorkOrderPayments->worklabor = $worklabor;
                            $newWorkOrderPayments->total = $total;
                            $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                            $newWorkOrderPayments->vat = $vat;
                            $newWorkOrderPayments->amountProducts = 0; // zero porque neste caso, nao tem
                            $newWorkOrderPayments->amoutwkwithoutprods = $totalWithVAT; // cotinua o mesmo, porque nesse caso, nao tem
                            $createInvoice = $newWorkOrderPayments->save();



                        if($newWorkOrderPayments){
                            $workOrderReference = $findWorkOrder->id;
                            $quoteReference = $findWorkOrder->quoteReference;

                            // workorder_payments;
                            // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                                $newInvoice = new workorder_invoice;
                                $newInvoice->machineId = $machineId;
                                $newInvoice->quoteReference =$quoteReference;
                                $newInvoice->workOrderReference = $workOrderReference;
                                $createInvoice = $newInvoice->save();

                        }


                        // atualizando valores do titulo e last observations na tabela work orders
                        if($createInvoice){
                            //att work order
                            $newWk =  workOrder::find($workOrderId);
                            $newWk->title = $title;
                            $newWk->last_observations =$last_observations;
                            $updateworkOrder = $newWk->save();
                        }


                            $id =  $request->id;
                            $Machine_Id =  $request->machine;
                            $typeofpayment =  $request->typeofpayment;
                            $nameCustomer =  $request->customer;
                            $dataConfirmPay = $request;
                            $product = $request->title;
                            $customer_report = $dataConfirmPay->customer_report;
                            $first_observations = $dataConfirmPay->first_observations;
                            // $last_observations = $dataConfirmPay->last_observations;
                            $newInvoiceId = $newInvoice->id;


                            // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                            return $newInvoiceId;
                        }
                }
            // FIM DA LOGICA CASO N TENHA PRODDUTOS, EXTRA SALES

        if($updatemachines){
            // VERIFICANDO SE VAO SER PRODUTOS COM EXTRA PRODUTOS OU SOMENTE PRODUTOS SOZINHOS
            $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
            if($findthisoverviewExtraItems == null){

                // only products
                    $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();

                //infos da pagina processing
                    $workOrderReference = $request->id;
                    $machineId = $findWorkOrder->machine;
                    $typeofpayment = $request->typeofpayment;
                    $discount = $request->discount;
                    $worklabor = $request->worklabor;

                    // Amount total dos produtos (PREÇOS SEM VAT)
                    $amountProducts = $findthisoverview->totalProductsonThisWk;

                    $SubTotal = $worklabor + $amountProducts; // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                    $vat = ($SubTotal * 0.20);
                    $subTotalWithVAT = ($SubTotal  + $vat);
                    $total = $SubTotal - $discount; // total without vat
                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat

                    $amoutwkwithoutprodscount = (($worklabor * 1.20) - $discount);
                    $request->worklabor == 0 ? $amoutwkwithoutprods =  0 : $amoutwkwithoutprods = $amoutwkwithoutprodscount;


                    // REMOVER PRODUTOS UTILIZADOS NESSA WORK ORDER
                    $findProductsOnThisWK = products_machines_workorders::where('workOrderReference', 'LIKE', $request->id)->get();


                    // da tabela produtos
                    foreach($findProductsOnThisWK as $item){
                        $prodctsFound =  $item->product_id;
                        $productsQuantity =  $item->productQuantity;

                        $achadoProduct = $findProduct = Product::find($prodctsFound)->first();
                        $cantidad = 155;

                        if($achadoProduct){
                            // decrementando a utilizada vendida da tabela products
                            $prod = Product::find($prodctsFound);
                            // return $prod->quantity;
                            $prod->quantity = $prod->quantity-=$productsQuantity;
                            $updateProd = $prod->save();
                        }

                    }
                    $ActualDate = date('d/m/y');

                    // workorder_payments;
                    // $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT, vat, amountProducts, amoutwkwithoutprods ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', []);
                    // $amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts, $findWorkOrder->price

                    $newWorkOrderPayments = new workorder_payments;
                    $newWorkOrderPayments->amount = $SubTotal;
                    $newWorkOrderPayments->machineId =$machineId;
                    $newWorkOrderPayments->typeofpayment = $typeofpayment;
                    $newWorkOrderPayments->discount = $discount;
                    $newWorkOrderPayments->workOrderReference = $workOrderReference;
                    $newWorkOrderPayments->worklabor = $worklabor;
                    $newWorkOrderPayments->total = $total;
                    $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                    $newWorkOrderPayments->vat = $vat;
                    $newWorkOrderPayments->amountProducts = $amountProducts;
                    $newWorkOrderPayments->amoutwkwithoutprods = $amoutwkwithoutprods;
                    $createInvoice = $newWorkOrderPayments->save();



                if($newWorkOrderPayments){
                    $workOrderReference = $findWorkOrder->id;
                    $quoteReference = $findWorkOrder->quoteReference;

                    // workorder_payments;
                    // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                        $newInvoice = new workorder_invoice;
                        $newInvoice->machineId = $machineId;
                        $newInvoice->quoteReference =$quoteReference;
                        $newInvoice->workOrderReference = $workOrderReference;
                        $createInvoice = $newInvoice->save();
                }

                // atualizando valores do titulo e last observations na tabela work orders
                if($createInvoice){
                    //att work order
                    $newWk =  workOrder::find($workOrderId);
                    $newWk->title = $title;
                    $newWk->last_observations =$last_observations;
                    $updateworkOrder = $newWk->save();
                }


                    $id =  $request->id;
                    $Machine_Id =  $request->machine;
                    $typeofpayment =  $request->typeofpayment;
                    $nameCustomer =  $request->customer;
                    $dataConfirmPay = $request;
                    $product = $request->title;
                    $customer_report = $dataConfirmPay->customer_report;
                    $first_observations = $dataConfirmPay->first_observations;
                    // $last_observations = $dataConfirmPay->last_observations;
                    $newInvoiceId = $newInvoice->id;


                    // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                    return $newInvoiceId;


            }

            else{
                    // products and extra items

                    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
                    $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;


                // only products
                    $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();


                //infos da pagina processing
                    $workOrderReference = $request->id;
                    $machineId = $findWorkOrder->machine;
                    $typeofpayment = $request->typeofpayment;
                    $discount = $request->discount;
                    $worklabor = $request->worklabor;

                    // Amount total dos produtos (PREÇOS SEM VAT)
                    $amountProducts = $findthisoverview->totalProductsonThisWk;

                    $SubTotal = ($worklabor + $amountProducts + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                    $vat = ($SubTotal * 0.20);
                    $subTotalWithVAT = ($SubTotal  + $vat);
                    $total = $SubTotal - $discount; // total without vat
                    $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
                    $amoutwkwithoutprods = ((($worklabor + $totalExtraItemsWithoutVAT)  * 1.20) - $discount);


                    // REMOVER PRODUTOS UTILIZADOS NESSA WORK ORDER
                    $findProductsOnThisWK = products_machines_workorders::where('workOrderReference', 'LIKE', $request->id)->get();


                    // da tabela produtos
                    foreach($findProductsOnThisWK as $item){
                        $prodctsFound =  $item->product_id;
                        $productsQuantity =  $item->productQuantity;

                        $achadoProduct = $findProduct = Product::find($prodctsFound)->first();
                        $cantidad = 155;

                        if($achadoProduct){
                            // decrementando a utilizada vendida da tabela products
                            $prod = Product::find($prodctsFound);
                            // return $prod->quantity;
                            $prod->quantity = $prod->quantity-=$productsQuantity;
                            $updateProd = $prod->save();
                        }

                    }
                    $ActualDate = date('d/m/y');



                    // workorder_payments;
                    // $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT, vat, amountProducts, amoutwkwithoutprods ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', []);
                    // $amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts, $findWorkOrder->price

                    $newWorkOrderPayments = new workorder_payments;
                    $newWorkOrderPayments->amount = $SubTotal;
                    $newWorkOrderPayments->machineId =$machineId;
                    $newWorkOrderPayments->typeofpayment = $typeofpayment;
                    $newWorkOrderPayments->discount = $discount;
                    $newWorkOrderPayments->workOrderReference = $workOrderReference;
                    $newWorkOrderPayments->worklabor = $worklabor;
                    $newWorkOrderPayments->total = $total;
                    $newWorkOrderPayments->totalWithVAT = $totalWithVAT;
                    $newWorkOrderPayments->vat = $vat;
                    $newWorkOrderPayments->amountProducts = $amountProducts;
                    $newWorkOrderPayments->amoutwkwithoutprods = $amoutwkwithoutprods;
                    $createInvoice = $newWorkOrderPayments->save();



                if($newWorkOrderPayments){
                    $workOrderReference = $findWorkOrder->id;
                    $quoteReference = $findWorkOrder->quoteReference;

                    // workorder_payments;
                    // $newInvoice = DB::insert('insert into workorder_invoice (machineId, quoteReference, workOrderReference) values (?, ?, ?)', [$machineId,  $quoteReference, $workOrderReference]);

                        $newInvoice = new workorder_invoice;
                        $newInvoice->machineId = $machineId;
                        $newInvoice->quoteReference =$quoteReference;
                        $newInvoice->workOrderReference = $workOrderReference;
                        $createInvoice = $newInvoice->save();
                }

                // atualizando valores do titulo e last observations na tabela work orders
                if($createInvoice){
                    //att work order
                    $newWk =  workOrder::find($workOrderId);
                    $newWk->title = $title;
                    $newWk->last_observations =$last_observations;
                    $updateworkOrder = $newWk->save();
                }


                    $id =  $request->id;
                    $Machine_Id =  $request->machine;
                    $typeofpayment =  $request->typeofpayment;
                    $nameCustomer =  $request->customer;
                    $dataConfirmPay = $request;
                    $product = $request->title;
                    $customer_report = $dataConfirmPay->customer_report;
                    $first_observations = $dataConfirmPay->first_observations;
                    // $last_observations = $dataConfirmPay->last_observations;
                    $newInvoiceId = $newInvoice->id;


                    // retornaremos somente o ajax para outra view onde ira exibir os dados dessa WK/invoice

                    return $newInvoiceId;

            }
        }


            // return redirect()->route('pays.gerarinvoice', ['id' => $id, 'machine' => $Machine_Id, 'typeofpayment' => $typeofpayment, 'nameCustomer' => $nameCustomer,
            // 'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report, 'first_observations' => $first_observations,
            // 'last_observations' => $last_observations,  'newInvoiceId' =>$newInvoiceId, 'amountProducts' => $amountProducts]);

    }


    public function gerarinvoice(Request $request){

        // id e workorderreference [e a mesma coisa no contexto ]
            $id =  $request->id;
            $workOrderReference = $id;
            $newInvoiceId =  $request->newInvoiceId;
            $newInvoiceCreatedDate =  $request->newInvoiceCreatedDate;

            // retornando dados desse invoice

            $findinvoice = workorder_invoice::find($newInvoiceId)->first();
            $invoicecreatedate = $findinvoice->created_at;
            $ThisinvoiceId = $findinvoice->id;

            // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
            $Machine_Id =  $request->machine;
            $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
            $machine_name = ($machine_info->model);
            $entry_machine_date = ($machine_info->created_at);

            // acha as peças na maquina where o id da work order for a mesma q a workorder atual
            $ProductsInfo = ShowProductsByMachines::whereRaw('workOrderReference = ' . $workOrderReference)->get();

            // infomações das work orders
             $allworkOrders = allworkorderinformations::whereRaw('machineId= ' . $Machine_Id)->first();


            $typeofpayment =  $request->typeofpayment;
            $nameCustomer =  $request->customer;
            $dataConfirmPay = $request;
            $product = $dataConfirmPay->title;

            $customer_report = $request->customer_report;
            $first_observations = $request->first_observations;
            $last_observations = $request->last_observations;

            // achando os valores na products workorders de acordo com o id da workorder dessa pagina
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
             $ProductsInfo2 = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();


            // retornando os valores que vao para o card geral dessa ordem de serviço
            $showonoverviewworkorders = showonoverviewworkorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();


            $workorder_payments= workorder_payments::where('workOrderReference', 'LIKE', $id)->first();

            $amountProducts  = $request->amountProducts;
            return view('sections.payments.paymentsConfirmed', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment', 'machine_name' ,'ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'workorder_payments', 'amountProducts', 'ThisinvoiceId'));

    }



    public function destroy($id)
    {
        // return $id;
        $deletePyAlreadyDone = workorder_payments::find($id)->delete();

        // $deleteWkinvoice = workorder_invoice::whereRaw('workOrderReference', 'LIKE', $id)->first()->delete();


        // {$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
        // {$deleteworkOrderPayments = workorder_payments::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
        // {$deleteworkorderinvoice = workorder_invoice::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}

        if($deletePyAlreadyDone){
            return redirect()
                        ->back()
                        ->with('success',  'The Payment was successful removed!' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }

}
