<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use App\Quote;
use App\Customer;
use App\Machine;
use App\allworkorderinformations;
use App\products_machines_workorders;
use App\Product;
use App\products_machines_quotes;
use App\productsmachinesworkordersallinfos;
use DB;
use App\ShowProductsByMachines;
use App\overviewbetweenworkorderandproductsqts;
use App\Http\Requests\Customer\WorkOrderFormRequest;
use App\Http\Requests\Customer\WorkOrderCreateFormRequest;
use App\workorder_payments;
use App\workorder_invoice;
use App\quotepreviewinvoice;
use App\totalprodsSelectedQuote;
use App\totalprodsSelectedWK;
use App\machineswithowner;
use App\extraitems;
use App\totalextraitemsworkOrderId;
use App\totalextraitemsquoteId;
use App\allwkpaymentsinfos;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function OpenWorkOrder(WorkOrderCreateFormRequest $request)
    {

        $id =  $request->id;

        $productmachinesquotes = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();
        if($productmachinesquotes == '[]'){
            return redirect()
            ->back()
            ->with('NoProdsQuotes', 'You need ADD products on your quote before continue');
        }

        // recupeando os dados dos quotes anteriores

        $ThisQuote = Quote::find($id);
        $ThisQuoteId = $ThisQuote->id;
        $title = $ThisQuote->title;
        $customer_report = $ThisQuote->customer_report;
        $first_observations = $ThisQuote->first_observations;
        $last_observations = $ThisQuote->last_observations;
        $customer = $ThisQuote->customer;
        $machine = $ThisQuote->machine;
        $status = $ThisQuote->status;
        $typeofpayment =  "none";


         $datas = ['title' => $title,
                    'customer_report' => $customer_report,
                    'last_observations' => $last_observations,
                    'customer' => $customer,
                    'machine' => $machine,
                    'status' => $status,
                    'typeofpayment'  => $typeofpayment,
                    'quoteReference'  => $ThisQuoteId
                ];

            $OpeningWorkOrder = WorkOrder::create($datas);
            $idWorkOrder = $OpeningWorkOrder->id;

            // QUOTE STATUS = 1 MEANS QUOTE  ALREADY IS WORK ORDER
            $ThisQuote->status = "1";
            $updatQuote = $ThisQuote->save();


        // adicionando quantidades e criando um invoice antes de virar uma work order em si

        if($OpeningWorkOrder){

            $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $request->id)->first();
            $amountProducts = $findthisoverview->totalProductsonThisQuote;
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
            // $SubTotal = ($worklabor  + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
            // $vat = ($SubTotal * 0.20);
            // $subTotalWithVAT = ($SubTotal  + $vat);
            // $total = $SubTotal - $discount; // total without vat
            // $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
            // return 1;
             $amount = (($request->amount) + $amountProducts) ; // AMOUNT É O SUBTOTAL
             $amountwithoutproducts = (($ThisQuote->amount)) ; // AMOUNT É O SUBTOTAL
             $machineId = $request->machine;
             $typeofpayment = $request->typeofpayment;
              $discount = $request->discount;
             $quoteReference = $request->id;
             $worklabor = $request->worklabor;

             $total = (($amount - $discount) +$worklabor);
             $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
            //  $subtotal = (($amount - $discount) +$worklabor);

             // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso
             $totalWithVAT = ($totalwithoutproducts * 0.20) + $total;

             // vat total *tirando os produtos que ja vieram com vat *
             $vat = ($totalwithoutproducts * 0.20);

             $ActualDate = date('d/m/y');

             // workorder_payments;
            //  $newInvoicePreview = DB::insert('insert into quotepreviewinvoice (amount, machineId,
            //   typeofpayment, discount, quoteReference, worklabor, total, totalWithVAT, vat, amountProducts,
            //   amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId,
            //    $typeofpayment, $discount, $quoteReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts,
            //     $request->amount, $ActualDate]);
                $datasNewInvoicePreview = ['amount' => $amount,
                'machineId' => $machineId,
                'typeofpayment' => $typeofpayment,
                'discount' => $discount,
                'quoteReference' => $quoteReference,
                'worklabor' => $worklabor,
                'total' => $total,
                'totalWithVAT'  => $totalWithVAT,
                'vat'  => $vat,
                'amountProducts'  => $amountProducts,
                'amoutwkwithoutprods'  => $request->amount,
            ];


            $newInvoicePreview = quotepreviewinvoice::create($datasNewInvoicePreview);


        }

        // finalizando



        if($OpeningWorkOrder){
            // pegando os dados da tabela products_machines_quotes para inseri-los na products_machines_workorders
                $productmachinesquotes = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();

                // pegando produtos selecionados
                foreach($productmachinesquotes as $item)
                {
                    $ProductsQuotes[] =  $item->product_id;
                }

                // pegando as quantidades

                foreach($productmachinesquotes as $itemqt)
                {
                    $ProductsQuantities[] =  $itemqt->productQuantity;
                }


                $max2 = sizeof($ProductsQuotes);
                if($max2 != 0)
                {
                    for($i =0; $i < $max2; $i++){
                        // return $uniao[$i];
                        $idProd =  $ProductsQuotes[$i];
                        $QtsProd =  $ProductsQuantities[$i];


                        $productmachinesquotes2 = products_machines_quotes::where('quoteReference', 'LIKE', $id)->first();

                        $createProdMachinesWK = new products_machines_workorders();
                        $createProdMachinesWK->machine_id = $productmachinesquotes2->machine_id;
                        $createProdMachinesWK->product_id = $idProd;
                        $createProdMachinesWK->workOrderReference = $idWorkOrder;
                        $createProdMachinesWK->quoteReference = $productmachinesquotes2->quoteReference;
                        $createProdMachinesWK->productQuantity = $QtsProd;
                        $updateProd = $createProdMachinesWK->save();

                        // When we used products_on_workorders
                        // if($updateProd){
                        //     // $product_id =  $createWorkOrder->product_id;
                        //     //daqui puxar os dados dos prods
                        //     $findthisproduct = Product::find($idProd);
                        //     $name = $findthisproduct->name;
                        //     $SKU = $findthisproduct->SKU;
                        //     $category = $findthisproduct->category;
                        //     $brand = $findthisproduct->brand;
                        //     $image = $findthisproduct->image;
                        //     $Sell_Price = $findthisproduct->Sell_Price;
                        //     $Sell_PriceVat = $findthisproduct->Sell_PriceVat;
                        //     $Cost_Price = $findthisproduct->Cost_Price;
                        //     $Sell_Discount = 0;
                        //     // valor padrao, inicial é 1
                        //     $quantity = 1;
                        //     $products_on_workorders = DB::insert('insert into products_on_workorders (name, SKU, category, brand, image, Sell_Price, Sell_PriceVat, Cost_Price, quantity, workOrderReference, Sell_Discount, product_id) values (?, ?,?,  ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $SKU, $category, $brand, $image, $Sell_Price, $Sell_PriceVat, $Cost_Price, $quantity, $idWorkOrder, $Sell_Discount, $idProd]);
                        // }

                    }
                }



                else{
                    return $respostaMachines =0;
                    $statusNulo = true;
                }



            // return redirect()
            //             ->route('workOrder.index')
            //             ->with('success',  'The Work Order was successful created!' );


            $id =  $request->id;
            $Machine_Id =  $request->machine;
            $typeofpayment =  $request->typeofpayment;
            $nameCustomer =  $request->customer;
            $dataConfirmPay = $request;
            $product = $dataConfirmPay->title;
            $customer_report = $dataConfirmPay->customer_report;
            $first_observations = $dataConfirmPay->first_observations;
            $last_observations = $dataConfirmPay->last_observations;
            $newInvoiceId = $newInvoicePreview->id;


            return redirect()->route('qt.gerarinvoice', ['id' => $id, 'machine' => $Machine_Id, 'typeofpayment' => $typeofpayment, 'nameCustomer' => $nameCustomer,
            'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report,
            'last_observations' => $last_observations,  'newInvoiceId' =>$newInvoiceId, 'amountProducts' => $amountProducts]);

            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
            }

        return redirect()->route('workOrder.index');
    }





    public function RefuseQuotation(Request $request)
    {
        $id =  $request->id;
        $machineId =  $request->machineId;

        $quote = Quote::find($id);
        if(isset($quote)){
            $quote->status = 3; // new status refused
            $updatequote = $quote->save();
        }
        return $quote->machine;

    }



    public function OpenWorkOrderAjax(WorkOrderCreateFormRequest $request)
    {
        $id =  $request->id;
        $title =  $request->title;
        $last_observations =  $request->last_observations;
        $worklabor =  $request->worklabor;
        $discount =  $request->discount;

        $request->last_observations == null? $last_observations = "Nothing to add" : $last_observations = $last_observations;

        $productmachinesquotes = products_machines_quotes::where('quoteReference', 'LIKE', $id)->first();
        if($productmachinesquotes == '[]' || $productmachinesquotes == null){

             $findDatasonRelationTableExtraItems = extraitems::where('quoteId', 'LIKE', $id)->first();

            if($findDatasonRelationTableExtraItems != null || $findDatasonRelationTableExtraItems != "")
            {

                    // SOMENTE EXTRA ITEMS
                    // return "SOMENTE EXTRA ITEMS";


                    $findthisoverviewExtraItems = totalextraitemsquoteId::where('quoteId', 'LIKE', $id)->first();
                    $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItems;

                    // recupeando os dados dos quotes anteriores
                    $id;
                    $ThisQuote = Quote::find($id);
                    $ThisQuoteId = $ThisQuote->id;

                    // $title = $ThisQuote->title;
                    $customer_report = $ThisQuote->customer_report;
                    $first_observations = $ThisQuote->first_observations;
                    // $last_observations = $ThisQuote->last_observations;
                    $customer = $ThisQuote->customer;
                    $machine = $ThisQuote->machine;
                    $status = $ThisQuote->status;
                    $typeofpayment =  "none";

                    $datas = ['title' => $title,
                                'customer_report' => $customer_report,
                                'last_observations' => $last_observations,
                                'customer' => $customer,
                                'machine' => $machine,
                                'status' => 0,
                                'typeofpayment'  => $typeofpayment,
                                'quoteReference'  => $ThisQuoteId,
                                'worklabor'  => $worklabor,
                                'discount'  => $discount
                            ];

                        $OpeningWorkOrder = WorkOrder::create($datas);
                        $idWorkOrder = $OpeningWorkOrder->id;

                        // QUOTE STATUS = 1 MEANS QUOTE  ALREADY IS WORK ORDER
                        $ThisQuote->status = "1";
                        $updatQuote = $ThisQuote->save();


                    // adicionando quantidades e criando um invoice antes de virar uma work order em si

                    if($OpeningWorkOrder){
                        //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();

                        //infos da pagina processing
                        $workOrderReference = $request->id;
                        $typeofpayment = $request->typeofpayment;
                        $discount = $request->discount;
                        $worklabor = $request->worklabor;

                        // Amount total dos produtos (PREÇOS SEM VAT)

                        $SubTotal = ($worklabor  + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                        $vat = ($SubTotal * 0.20);
                        $subTotalWithVAT = ($SubTotal  + $vat);
                        $total = $SubTotal - $discount; // total without vat
                        $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


                        // é o total completo JA COM DESCONTO, VTA E ETC
                        // 'totalWithVAT'  => $total,

                        // workorder_payments;
                        //  $newInvoicePreview = DB::insert('insert into quotepreviewinvoice (amount, machineId,
                        //   typeofpayment, discount, quoteReference, worklabor, total, totalWithVAT, vat, amountProducts,
                        //   amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId,
                        //    $typeofpayment, $discount, $quoteReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts,
                        //     $request->amount, $ActualDate]);
                            $datasNewInvoicePreview = ['amount' => $SubTotal,
                            'machineId' => $machine,
                            'typeofpayment' => $typeofpayment,
                            'discount' => $discount,
                            'quoteReference' => $ThisQuoteId,
                            'worklabor' => $worklabor,
                            'total' => $total,
                            'totalWithVAT'  => $totalWithVAT,
                            'vat'  => $vat,
                            'amountProducts'  => 0,
                            'amoutwkwithoutprods'  => $SubTotal,
                        ];


                        $newInvoicePreview = quotepreviewinvoice::create($datasNewInvoicePreview);



                        // ADDING ALL NEW ITEMS TO THE NEW ORDER
                            $findDatasonRelationTableExtraItems = extraitems::where('quoteId', 'LIKE', $id)->first();
                            if($findDatasonRelationTableExtraItems != null || $findDatasonRelationTableExtraItems != "")
                            {
                                DB::table('extraitems')
                                    ->where('quoteId', $id)
                                    ->update(['workOrderId' => $idWorkOrder]);
                            }
                    // END ADDING ALL NEW ITEMS

                    }

                    // finalizando

                    return $idWorkOrder;
            }

            else{

                    // return "only WK";
                    // recupeando os dados dos quotes anteriores
                    $ThisQuote = Quote::find($id);
                    $ThisQuoteId = $ThisQuote->id;
                    // $title = $ThisQuote->title;
                    $customer_report = $ThisQuote->customer_report;
                    $first_observations = $ThisQuote->first_observations;
                    // $last_observations = $ThisQuote->last_observations;
                    $customer = $ThisQuote->customer;
                    $machine = $ThisQuote->machine;
                    $status = $ThisQuote->status;
                    $typeofpayment =  "none";

                    $datas = ['title' => $title,
                                'customer_report' => $customer_report,
                                'last_observations' => $last_observations,
                                'customer' => $customer,
                                'machine' => $machine,
                                'status' => $status,
                                'typeofpayment'  => $typeofpayment,
                                'quoteReference'  => $ThisQuoteId,
                                'worklabor'  => $worklabor,
                                'discount'  => $discount
                            ];

                        $OpeningWorkOrder = WorkOrder::create($datas);
                        $idWorkOrder = $OpeningWorkOrder->id;

                        // QUOTE STATUS = 1 MEANS QUOTE  ALREADY IS WORK ORDER
                        $ThisQuote->status = "1";
                        $updatQuote = $ThisQuote->save();


                    // adicionando quantidades e criando um invoice antes de virar uma work order em si

                    if($OpeningWorkOrder){
                        //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();

                        //infos da pagina processing
                        $workOrderReference = $request->id;
                        $typeofpayment = $request->typeofpayment;
                        $discount = $request->discount;
                        $worklabor = $request->worklabor;

                        // Amount total dos produtos (PREÇOS SEM VAT)

                        $SubTotal = ($worklabor); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                        $vat = ($SubTotal * 0.20);
                        $subTotalWithVAT = ($SubTotal  + $vat);
                        $total = $SubTotal - $discount; // total without vat
                        $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


                        // é o total completo JA COM DESCONTO, VTA E ETC
                        // 'totalWithVAT'  => $total,

                        // workorder_payments;
                        //  $newInvoicePreview = DB::insert('insert into quotepreviewinvoice (amount, machineId,
                        //   typeofpayment, discount, quoteReference, worklabor, total, totalWithVAT, vat, amountProducts,
                        //   amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId,
                        //    $typeofpayment, $discount, $quoteReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts,
                        //     $request->amount, $ActualDate]);
                            $datasNewInvoicePreview = ['amount' => $SubTotal,
                            'machineId' => $machine,
                            'typeofpayment' => $typeofpayment,
                            'discount' => $discount,
                            'quoteReference' => $ThisQuoteId,
                            'worklabor' => $worklabor,
                            'total' => $total,
                            'totalWithVAT'  => $totalWithVAT,
                            'vat'  => $vat,
                            'amountProducts'  => 0,
                            'amoutwkwithoutprods'  => $SubTotal,
                        ];


                        $newInvoicePreview = quotepreviewinvoice::create($datasNewInvoicePreview);


                    }

                    // finalizando
                    return $idWorkOrder;

            }

        }

            // return "nao é somento Wk e nem somente product";
            // recupeando os dados dos quotes anteriores

            $ThisQuote = Quote::find($id);
            if($ThisQuote != null | $ThisQuote != ""){
                $ThisQuoteId = $ThisQuote->id;
                $quoteReference = $ThisQuote->id;
                // $title = $ThisQuote->title;
                $customer_report = $ThisQuote->customer_report;
                $first_observations = $ThisQuote->first_observations;
                // $last_observations = $ThisQuote->last_observations;
                $customer = $ThisQuote->customer;
                $machine = $ThisQuote->machine;
                $status = $ThisQuote->status;
                $typeofpayment =  "none";
            }
            else{
                return redirect()
                ->route('quote.index')
                ->with('success',  'Was not possible create this Quote!' );
            }


            $datas = ['title' => $title,
                        'customer_report' => $customer_report,
                        'last_observations' => $last_observations,
                        'customer' => $customer,
                        'machine' => $machine,
                        'status' => $status,
                        'typeofpayment'  => $typeofpayment,
                        'quoteReference'  => $ThisQuoteId,
                        'worklabor'  => $worklabor,
                        'discount'  => $discount
                    ];

                $OpeningWorkOrder = WorkOrder::create($datas);
                $idWorkOrder = $OpeningWorkOrder->id;

                // QUOTE STATUS = 1 MEANS QUOTE  ALREADY IS WORK ORDER
                $ThisQuote->status = "1";
                $updatQuote = $ThisQuote->save();


            // adicionando quantidades e criando um invoice antes de virar uma work order em si

            // return "chegando aqui";


            $findthisoverviewExtraItems = totalextraitemsquoteId::where('quoteId', 'LIKE', $id)->first();

                    if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                    {
                                $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $request->id)->first();
                                $amountProducts = $findthisoverview->totalProductsonThisQuote;


                                //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();

                                // return $a = [$worklabor, $amountProducts, $totalExtraItemsWithoutVAT];

                                $SubTotal = ($worklabor + $amountProducts); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                                $vat = ($SubTotal * 0.20);
                                $subTotalWithVAT = ($SubTotal  + $vat);
                                $total = $SubTotal - $discount; // total without vat
                                $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
                                $amoutwkwithoutprods = ((($worklabor)  * 1.20) - $discount);

                                $ActualDate = date('d/m/y');

                                // workorder_payments;
                                //  $newInvoicePreview = DB::insert('insert into quotepreviewinvoice (amount, machineId,
                                //   typeofpayment, discount, quoteReference, worklabor, total, totalWithVAT, vat, amountProducts,
                                //   amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId,
                                //    $typeofpayment, $discount, $quoteReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts,
                                //     $request->amount, $ActualDate]);


                                    $datasNewInvoicePreview = ['amount' => $SubTotal,
                                    'machineId' => $machine,
                                    'typeofpayment' => $typeofpayment,
                                    'discount' => $discount,
                                    'quoteReference' => $quoteReference,
                                    'worklabor' => $worklabor,
                                    'total' => $total,// total - vat
                                    'totalWithVAT'  => $totalWithVAT,
                                    'vat'  => $vat,
                                    'amountProducts'  => $amountProducts,
                                    'amoutwkwithoutprods'  => $amoutwkwithoutprods,
                                ];


                                $newInvoicePreview = quotepreviewinvoice::create($datasNewInvoicePreview);

                                // return "chegando aqui 3";

                                // return $idWorkOrder;
                            }

                    else{
                            // return "chegando aqui 4";

                            // return "com produto com extra";
                            $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $request->id)->first();
                            $amountProducts = $findthisoverview->totalProductsonThisQuote;

                            $findthisoverviewExtraItems = totalextraitemsquoteId::where('quoteId', 'LIKE', $request->id)->first();
                            $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItems;


                            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();

                            // return $a = [$worklabor, $amountProducts, $totalExtraItemsWithoutVAT];

                            $SubTotal = ($worklabor + $amountProducts + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                            $vat = ($SubTotal * 0.20);
                            $subTotalWithVAT = ($SubTotal  + $vat);
                            $total = $SubTotal - $discount; // total without vat
                            $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
                            $amoutwkwithoutprods = ((($worklabor + $totalExtraItemsWithoutVAT)  * 1.20) - $discount);

                            $ActualDate = date('d/m/y');

                            // workorder_payments;
                            //  $newInvoicePreview = DB::insert('insert into quotepreviewinvoice (amount, machineId,
                            //   typeofpayment, discount, quoteReference, worklabor, total, totalWithVAT, vat, amountProducts,
                            //   amoutwkwithoutprods, created_at ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId,
                            //    $typeofpayment, $discount, $quoteReference, $worklabor, $total, $totalWithVAT, $vat, $amountProducts,
                            //     $request->amount, $ActualDate]);
                                $datasNewInvoicePreview = ['amount' => $SubTotal,
                                'machineId' => $machine,
                                'typeofpayment' => $typeofpayment,
                                'discount' => $discount,
                                'quoteReference' => $quoteReference,
                                'worklabor' => $worklabor,
                                'total' => $total,// total - vat
                                'totalWithVAT'  => $totalWithVAT,
                                'vat'  => $vat,
                                'amountProducts'  => $amountProducts,
                                'amoutwkwithoutprods'  => $amoutwkwithoutprods,
                            ];


                            $newInvoicePreview = quotepreviewinvoice::create($datasNewInvoicePreview);


                        }


                        // finalizando ja que ambos vao terminar no mesmo lugar!
                        if($OpeningWorkOrder){
                                // pegando os dados da tabela products_machines_quotes para inseri-los na products_machines_workorders
                                    $productmachinesquotes = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();

                                    // pegando produtos selecionados
                                    foreach($productmachinesquotes as $item)
                                    {
                                        $ProductsQuotes[] =  $item->product_id;
                                    }

                                    // pegando as quantidades

                                    foreach($productmachinesquotes as $itemqt)
                                    {
                                        $ProductsQuantities[] =  $itemqt->productQuantity;
                                    }


                                    $max2 = sizeof($ProductsQuotes);
                                    if($max2 != 0)
                                    {
                                        for($i =0; $i < $max2; $i++){
                                            // return $uniao[$i];
                                            $idProd =  $ProductsQuotes[$i];
                                            $QtsProd =  $ProductsQuantities[$i];


                                            $productmachinesquotes2 = products_machines_quotes::where('quoteReference', 'LIKE', $id)->first();

                                            $createProdMachinesWK = new products_machines_workorders();
                                            $createProdMachinesWK->machine_id = $machine;
                                            $createProdMachinesWK->product_id = $idProd;
                                            $createProdMachinesWK->workOrderReference = $idWorkOrder;
                                            $createProdMachinesWK->quoteReference = $productmachinesquotes2->quoteReference;
                                            $createProdMachinesWK->productQuantity = $QtsProd;
                                            $updateProd = $createProdMachinesWK->save();

                                            // When we used products_on_workorders
                                            // if($updateProd){
                                            //     // $product_id =  $createWorkOrder->product_id;
                                            //     //daqui puxar os dados dos prods
                                            //     $findthisproduct = Product::find($idProd);
                                            //     $name = $findthisproduct->name;
                                            //     $SKU = $findthisproduct->SKU;
                                            //     $category = $findthisproduct->category;
                                            //     $brand = $findthisproduct->brand;
                                            //     $image = $findthisproduct->image;
                                            //     $Sell_Price = $findthisproduct->Sell_Price;
                                            //     $Sell_PriceVat = $findthisproduct->Sell_PriceVat;
                                            //     $Cost_Price = $findthisproduct->Cost_Price;
                                            //     $Sell_Discount = 0;
                                            //     // valor padrao, inicial é 1
                                            //     $quantity = 1;
                                            //     $products_on_workorders = DB::insert('insert into products_on_workorders (name, SKU, category, brand, image, Sell_Price, Sell_PriceVat, Cost_Price, quantity, workOrderReference, Sell_Discount, product_id) values (?, ?,?,  ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $SKU, $category, $brand, $image, $Sell_Price, $Sell_PriceVat, $Cost_Price, $quantity, $idWorkOrder, $Sell_Discount, $idProd]);
                                            // }

                                        }

                                        // ADDING ALL NEW ITEMS TO THE NEW ORDER
                                            $findDatasonRelationTableExtraItems = extraitems::where('quoteId', 'LIKE', $id)->first();
                                            if($findDatasonRelationTableExtraItems != null || $findDatasonRelationTableExtraItems != "")
                                            {

                                                DB::table('extraitems')
                                                    ->where('quoteId', $id)
                                                    ->update(['workOrderId' => $idWorkOrder]);

                                            }
                                        // END ADDING ALL NEW ITEMS

                                    }



                                    else{
                                        return $respostaMachines =0;
                                        $statusNulo = true;
                                    }



                                // return redirect()
                                //             ->route('workOrder.index')
                                //             ->with('success',  'The Work Order was successful created!' );


                                $id =  $request->id;
                                $Machine_Id =  $machine;
                                $typeofpayment =  $request->typeofpayment;
                                $nameCustomer =  $request->customer;
                                $dataConfirmPay = $request;
                                $product = $dataConfirmPay->title;
                                $customer_report = $dataConfirmPay->customer_report;
                                $first_observations = $dataConfirmPay->first_observations;
                                $last_observations = $dataConfirmPay->last_observations;
                                $newInvoiceId = $newInvoicePreview->id;

                                // return redirect()->route('qt.gerarinvoice', ['id' => $id, 'machine' => $Machine_Id, 'typeofpayment' => $typeofpayment, 'nameCustomer' => $nameCustomer,
                                // 'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report, => $first_observations,
                                // 'last_observations' => $last_observations,  'newInvoiceId' =>$newInvoiceId, 'amountProducts' => $amountProducts]);

                            return $idWorkOrder;
                }
    }


    public function index($id=null)
    {
        if($id == null){
            // $allworkOrders = allworkorderinformations::all();
            $thisCustomerStatus = 0;
            $thisCustomer = 0;
            $WKpaymentsStatus = 0;
            $NthisCustomerMachines = 0;
            $NthisCustomerWK = 0;
            $NbikesBought = 0;
            $NthisCustomerProductsBought = 0;
            $workorder_payments = 0;
            $Nappointments = 0;
            $allworkOrders = allworkorderinformations::where('status', '!=', '1')->get();
        }

        else if($id == "waitingforcollections")
        {
            // $allworkOrders = allworkorderinformations::all();
            $thisCustomerStatus = 0;
            $thisCustomer = 0;
            $WKpaymentsStatus = 0;
            $NthisCustomerMachines = 0;
            $NthisCustomerWK = 0;
            $NbikesBought = 0;
            $NthisCustomerProductsBought = 0;
            $workorder_payments = 0;
            $Nappointments = 0;
            $allworkOrders = allworkorderinformations::where('status', '=', '2')->get();
        }

        else{

            $thisCustomer = Customer::find($id);
            $thisCustomerStatus = 1;
            // $allworkOrders = allworkorderinformations::all();
            $allworkOrders = allworkorderinformations::where('customerId', '=', $id)->get();
            $workorder_payments= allwkpaymentsinfos::where('owner', '=', $id)->get();
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
        }


        return view('sections.workOrder.index', compact('allworkOrders', 'thisCustomerStatus', 'thisCustomer', 'NthisCustomerMachines',
        'NthisCustomerWK','NbikesBought', 'Nappointments',
        'NthisCustomerProductsBought', 'workorder_payments', 'WKpaymentsStatus'));

    }

    public function allworkorder($id = null, $from = null)
    {
        // $allworkOrders = allworkorderinformations::all();


        if($from == "MachineViewPage"){
            $allworkOrders = allworkorderinformations::where('status', '1')->where('machine', 'LIKE', $id)->get();
            $getWkOwnerInfos = allworkorderinformations::where('machine', 'LIKE', $id)->first();
            if($getWkOwnerInfos == null || $getWkOwnerInfos == "" || $getWkOwnerInfos == "[]"){
                    return redirect()
                    ->back()
                    ->with('error',  'You dont have previous work orders to see' );
            }
            else{
                $customerName = $getWkOwnerInfos->customerName;
                $customerId = $getWkOwnerInfos->customerId;
                return view('sections.workOrder.allworkorder', compact('allworkOrders', 'getWkOwnerInfos', 'customerName', 'customerId'));
            }

        }
        else
        {
            // $allworkOrders = allworkorderinformations::all();
            $allworkOrders = allworkorderinformations::where('status', '1')->get();
            return view('sections.workOrder.allworkorder', compact('allworkOrders'));
        }

    }

    public function create($id = null)
    {

        if($id == null){
            $allcustomers = Customer::all();
            $allmachines = Machine::all();
            $allproducts = Product::all();
            $routeBack = "indexPage";
            return view('sections.workOrder.create', compact('allcustomers', 'allmachines', 'allproducts','routeBack', 'id'));
        }

        else{
                $allmachines = Machine::find($id);

                if($allmachines == "")
                {
                    $allcustomers = Customer::all();
                    $allmachines = Machine::all();
                    $allproducts = Product::all();
                    $routeBack = "indexPage";
                    return view('sections.workOrder.create', compact('allcustomers', 'allmachines', 'allproducts','routeBack', 'id'));
                }


                else
                {
                    $allcustomers = Customer::all();
                    $allmachines = Machine::find($id);
                    $allproducts = Product::all();
                    $routeBack = "machineViewPage";
                    $isMachineID = true;
                    return view('sections.workOrder.create', compact('allcustomers', 'allmachines', 'allproducts','routeBack', 'id', 'isMachineID'));
                }
        }


    }

    public function store(WorkOrderCreateFormRequest $request)
    {

        $customer_report = $request->customer_report;

        if($request->wkservice == 'NaN' || $request->wkservice == null || $request->discount == 'NaN' || $request->discount == null){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }

        $machine =  $request->machine;
        if($machine == null){
            return redirect()
            ->back()
            ->with('warning',  'You cannot create this Work Order  because there is no Machine Selected' );
        }



        $wkservice =  $request->wkservice;
        $discount =  $request->discount;
        $request->title == null ? $title =  'No title' : $title = $request->title;
        $request->last_observations == null ? $last_observations =  'No last_observations' : $last_observations = $request->last_observations;
        $customer_report== null ? $customer_report =  'No customer report' : $$customer_report = $customer_report;

        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);


        // 'title', 'customer_report',  'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $createWorkOrder = new WorkOrder();
        $createWorkOrder->title = $title;
        $createWorkOrder->customer_report = $customer_report;
        $createWorkOrder->last_observations = $last_observations;
        $createWorkOrder->customer = $allmachines->owner;
        $createWorkOrder->machine = $request->input('machine');
        $createWorkOrder->status = $request->input('status');
        $createWorkOrder->worklabor = $wkservice;
        $createWorkOrder->discount = $discount;
        $createWorkOrder->mileage =  $allmachines->mileage;
        $createWorkOrder->quoteReference = 0;
        $updateProd = $createWorkOrder->save();
        $thiswkId = $createWorkOrder->id;


        if($updateProd){
            // machines selected
            $Productsoptions =  $request->Productsoptions;

            $machineId = $createWorkOrder->machine;
            // $productId = $createQuote->product;
            $workOrderReference = $createWorkOrder->id;
            $quoteReference = 0;
            $created_at = $createWorkOrder->created_at;
            $updated_at = $createWorkOrder->updated_at;

            if($Productsoptions){
                // verificando se algum produto foi selecionado
                foreach ($Productsoptions as $key => $ProdObj)
                {
                    $vals = $request->Productsoptions;
                    // $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);

                    $productsInfos = Product::find($ProdObj);
                    $productName = $productsInfos->name;
                    $image = $productsInfos->image;
                    $SKU = $productsInfos->SKU;
                    $brand = $productsInfos->brand;
                    $Sell_PriceVat = $productsInfos->Sell_PriceVat;
                    $Sell_Price = $productsInfos->Sell_Price;
                    $Cost_Price = $productsInfos->Cost_Price;
                    $condition = $productsInfos->condition;
                    $supplier = $productsInfos->supplier;

                    $createWorkOrder = new products_machines_workorders();
                    $createWorkOrder->machine_id = $machine_id;
                    $createWorkOrder->product_id = $ProdObj;
                    $createWorkOrder->productName = $productName;
                    $createWorkOrder->image = $image;
                    $createWorkOrder->SKU = $SKU;
                    $createWorkOrder->brand = $brand;
                    $createWorkOrder->workOrderReference = $workOrderReference;
                    $createWorkOrder->quoteReference = $quoteReference;
                    $createWorkOrder->productQuantity = 1;
                    $createWorkOrder->Sell_PriceVat = $Sell_PriceVat;
                    $createWorkOrder->Sell_Price = $Sell_Price;
                    $createWorkOrder->Cost_Price = $Cost_Price;
                    $createWorkOrder->condition = $condition;
                    $createWorkOrder->supplier = $supplier;
                    $createWorkOrder->created_at = $created_at;
                    $createWorkOrder->updated_at = $updated_at;
                    $updateProd12 = $createWorkOrder->save();
                }

            // extra items
                 // machines selected
                 $DescriptionName =  $request->DescriptionName;
                    // $Sell_Price =  $request->Sell_Price;
                    $Sell_PriceVat =  $request->Sell_PriceVat;


                    if($DescriptionName){
                        $max4 = sizeof($DescriptionName);
                        for($i =0; $i < $max4; $i++)
                        {
                            $vals = $request->Sell_Price;
                            // $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);
                            // 'name', 'Sell_Price', 'Sell_PriceVat', 'about', 'condition', 'quoteId', 'workOrderId'
                            $createExtraItems = new extraitems();
                            $createExtraItems->name = $DescriptionName[$i];
                            $createExtraItems->Sell_Price = ($Sell_PriceVat[$i] / 1.20);
                            $createExtraItems->Sell_PriceVat = $Sell_PriceVat[$i];
                            $createExtraItems->about = "extrasales";
                            $createExtraItems->condition = "extra";
                            $createExtraItems->quoteId = 0;
                            $createExtraItems->workOrderId = $thiswkId;
                            $updateExtraItems = $createExtraItems->save();

                        }
                    }
                // fim extra items
            }


            if($Productsoptions == "" || $Productsoptions == null ){
                    // caso nao tenha nenhum produto
                    $DescriptionName =  $request->DescriptionName;
                    // $Sell_Price =  $request->Sell_Price;
                    $Sell_PriceVat =  $request->Sell_PriceVat;


                    if($DescriptionName){
                        $max4 = sizeof($DescriptionName);
                        for($i =0; $i < $max4; $i++)
                        {
                            $vals = $request->Sell_Price;
                            // $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);
                            // 'name', 'Sell_Price', 'Sell_PriceVat', 'about', 'condition', 'quoteId', 'workOrderId'
                            $createExtraItems = new extraitems();
                            $createExtraItems->name = $DescriptionName[$i];
                            $createExtraItems->Sell_Price = ($Sell_PriceVat[$i] / 1.20);
                            $createExtraItems->Sell_PriceVat = $Sell_PriceVat[$i];
                            $createExtraItems->about = "extrasales";
                            $createExtraItems->condition = "extra";
                            $createExtraItems->quoteId = 0;
                            $createExtraItems->workOrderId = $thiswkId;
                            $updateExtraItems = $createExtraItems->save();

                        }
                    }
                // fim extra items
            }




                    // se algum produto foi selecionado
        if($request->Productsoptions){
            return redirect()->route('wk.chooseQuantity', ['id' => $thiswkId]);
        }
        else{
            return redirect()
                ->route('machine.viewPage', ['id' => $machineId])
                ->with('success',  'The Work Order was successfull created!' );
        }
    }


}





public function chooseQuantity(Request $request)
{

        
        $id = $request->id;
        $allwk = allworkorderinformations::find($id);
        // name of the customer
        $name = $allwk->customer;

        // name of the machine

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        // all products
        $lista = DB::table('products')->get();
        // this actual quote
        $findProducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->get();

        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id do quote atual
        $outrasop = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();

        $opcoesMarcadas = array();


        // todos os produtos referenciados à essa quote
        foreach($findProducts as $item){
            $opcoesMarcadas[] =  $item->product_id;
        }

        // todos produtos existentes na tabela products
        foreach($lista as $item){
            $todosProdutos[] =  $item->id;
        }

        // array  de resposta que ira pegar quais produtos sao diferentes entre o que voce tem na quote e os que ja existem na tabela products
        $array3 = array();
        foreach($todosProdutos as $produtos){
            // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
            if(!in_array($produtos, $opcoesMarcadas)){
                $array3[] =  $produtos;
            }
        }

        $max2 = sizeof($array3);
        if($max2 != 0)
        {
            for($i =0; $i < $max2; $i++){
                // return $uniao[$i];
                $allproducts2 = Product::find($array3[$i]);
                $respostaProducts[] =  $allproducts2;
                $statusNulo = false;
            }
        }
        else{
            $respostaProducts =0;
            $statusNulo = true;
        }


        // products in this actual quote
        $ProductsInfo  = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->get();

    if($ProductsInfo != '[]'){
        // add a um array todos os ids de produtos encontrados nessa ordem de serviço
        foreach($ProductsInfo as $item){
            $ProductsInfoIds[] =  $item->product_id;
        }

            // com esse array de ids vou fazer um foreach para buscar cada um desses itens na tabela produtos e me retornar tudo sobre ele naquela posição
            $max4 = sizeof($ProductsInfoIds);
            if($max4 != 0)
            {
                for($i =0; $i < $max4; $i++){
                    // return $uniao[$i];
                    $allproducsbyworkorders = Product::find($ProductsInfoIds[$i]);
                    $productsonthisWorkOrder[] =  $allproducsbyworkorders;
                    $statusNulo2 = true;
                }
            }
    }

    else{
            $productsonthisWorkOrder =0;
            $statusNulo2 = false;
        }   



        // $productsAndQuantities[] =  $productName[$i]. " and" . " quantity " . $productQuantity[$i];

        return view('sections.workOrder.addingQuantities', compact('allwk', 'allcustomers', 'allmachines','name', 'allproducts', 'allproducts2', 'statusNulo', 'respostaProducts', 'outrasop', 'ProductsInfo', 'id', 'productsonthisWorkOrder', 'statusNulo2'));

}


public function checarInvoiceSemCadastrar(Request $request)
{   


    $mileage = $request->mileage;

    if($request->worklabor == 'NaN' || $request->worklabor == null || $request->worklabor == '' ||
    $request->discount == 'NaN' || $request->discount == null || $request->discount == ''

    ){
        return redirect()
        ->back()
        ->with('warning',  'You must add a valid value for the service and discount' );
    }

    $id =  $request->id;
    $title =  $request->title;
    $last_observations =  $request->last_observations;

    // id e quoteReference [e a mesma coisa no contexto ]
    $quoteReference = $id;
    $newInvoiceId =  0;

    $newInvoiceCreatedDate =  date('d/m/Y');
    $invoicecreatedate =  $newInvoiceCreatedDate;




    $thisQuoteId = $id;

    //pra achar o id da machine e outras infos do QUOTE
        $findWk = workorder::find($id);
        $Machine_Id = $findWk->machine;
        $nameCustomer =  $findWk->customer;
        $product = $findWk->title;
        $customer_report = $findWk->customer_report;
        $first_observations = $findWk->first_observations;
        // $last_observations = $findWk->last_observations;
        $created_at = $findWk->created_at;

    //

    $allworkOrdersCreatedAt =  date('d/m/Y', strtotime($created_at));
    $allwkcreatedat =  $allworkOrdersCreatedAt;


    // logica para maquina inexistente
    $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
    $machine_model = ($machine_info->model);
    $machine_brand = ($machine_info->brand);
    $bikemileage = ($machine_info->mileage);
    $entry_machine_date = ($machine_info->created_at);
    $entry_machine_date =  date('d/m/Y', strtotime($entry_machine_date));


    // acha as peças na maquina where o id da work order for a mesma q a workorder atual
    $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();

    $ProductsInfo2 = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();

    // infomações das work orders

    $allworkOrders = allworkorderinformations::where('id', 'LIKE',  $id)->first();



    // dados dos campos que colocamos manualmente (discount, work labour)
    // E DADOS GERAIS

    // vendo a soma dos produtos nessa work Order

    // VER EM QUAL ROTA ELE SERÁ REDIRECIONADO

    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $id)->first();
    $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();

     if($findthisoverview == "" || $findthisoverview == null ){
            // return "sem produto";

                if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                {
                       // return "sem produto nem nada";

                        //infos da pagina processing
                        $workOrderReference = $request->id;
                        $machineId = $findWk->machine;
                        $typeofpayment = $request->typeofpayment;
                        $discount = $request->discount;
                        $worklabor = $request->worklabor;

                        $SubTotal = $worklabor  ;
                        $vat = ($SubTotal * 0.20);
                        $subTotalWithVAT = ($SubTotal  + $vat);
                        $total = $SubTotal - $discount; // total without vat
                        $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


                        $SubTotalFormated = $worklabor; // SOMANDO COM O TOTAL DOS VALORES EXTRAS
                        $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');
                        // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');

                        $totalWithVAT =  ($subTotalWithVAT - $discount);
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $onlyServiceMsg = "enabled";
                        $ProductsSatus = "empty";
                        $totalExtraItemsStatus = "empty";

                        $discount = number_format($discount, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');


                        return view('sections.workOrder.previewqts.wkinvoice', compact('machine_info', 'mileage', 'bikemileage','nameCustomer','ProductsInfo', 'allworkOrders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'thisQuoteId', 'invoicecreatedate', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'totalWithVAT',  'allwkcreatedat', 'machine_model', 'machine_brand', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus','onlyServiceMsg', 'ProductsSatus','vat'));

                }


                else{

                        // ONLY EXTRA ITEMS
                        // return "only extra items";
                        $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
                        $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;

                        // only products


                        //infos da pagina processing
                        $workOrderReference = $request->id;
                        $machineId = $findWk->machine;
                        $typeofpayment = $request->typeofpayment;
                        $discount = $request->discount;
                        $worklabor = $request->worklabor;

                        // Amount total dos produtos (PREÇOS SEM VAT)

                        $SubTotal = ($worklabor  + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                        $vat = ($SubTotal * 0.20);
                        $subTotalWithVAT = ($SubTotal  + $vat);
                        $total = $SubTotal - $discount; // total without vat
                        $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


                        $SubTotalFormated = number_format($SubTotal, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($SubTotal, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');
                        $totalExtraItemsStatus = "setup";

                        $allextraitems = extraitems::where('workOrderId', 'LIKE', $id)->get();
                        $ProductsStatus = "empty";

                        return view('sections.workOrder.previewqts.wkinvoice', compact('machine_info', 'mileage', 'bikemileage', 'nameCustomer','ProductsInfo', 'allworkOrders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'thisQuoteId', 'invoicecreatedate', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'total', 'totalWithVAT', 'allwkcreatedat', 'machine_model', 'machine_brand', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems', 'totalExtraItemsWithoutVAT', 'ProductsStatus', 'vat'));

            }

        }






    // FIM DAS ROTAS REDIRECIONADAS

    $amountProducts = $findthisoverview->totalProductsonThisWk;
    $amount = (($request->amount) + $amountProducts) ; // AMOUNT É O SUBTOTAL
    $amountwithoutproducts = (($request->amount)) ; // AMOUNT É O SUBTOTAL
    $machineId = $request->machine;
    $typeofpayment = $request->typeofpayment;
    $discount = $request->discount;
    $workOrderReference = $request->id;
    $worklabor = $request->worklabor;
    $total = (($amount - $discount) +$worklabor);
    $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
//  $subtotal = (($amount - $discount) +$worklabor);
    // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso
    $totalWithVAT = ($totalwithoutproducts * 0.20) + $total;
    // vat total *tirando os produtos que ja vieram com vat *
    $vat = ($totalwithoutproducts * 0.20);
    $SubTotalFormated = $amount + $worklabor;




    $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');
    $vat = number_format($vat, 2, '.',',');
    $amount = number_format($amount, 2, '.',',');
    $discount = number_format($discount, 2, '.',',');
    $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
    $amountProducts = number_format($amountProducts, 2, '.',',');
    $worklabor = number_format($worklabor, 2, '.',',');



     // extraitems
        // o total dos extraitems somados
        $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $id)->first();

        if($findthisoverviewExtraItems == null){

            // return "sOMENTE PRODUTOS";

            $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();
            $amountProducts = $findthisoverview->totalProductsonThisWk;

            $SubTotal = $worklabor + $amountProducts;
            $vat = ($SubTotal * 0.20);
            $subTotalWithVAT = ($SubTotal  + $vat);
            $total = $SubTotal - $discount; // total without vat
            $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


            $SubTotalFormated = number_format($SubTotal, 2, '.',',');
            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
            $amountProducts = number_format($amountProducts, 2, '.',',');
            $vat = number_format($vat, 2, '.',',');

            // quando  nao tiver extraitems vamos setar o valor para 0;
            $totalExtraItemsVAT = 0;
            $totalExtraItemsStatus = "empty";

            $allextraitems = extraitems::where('workOrderId', 'LIKE', $id)->get ();
            //endextraitems
            return view('sections.workOrder.previewqts.wkinvoice', compact('machine_info','mileage', 'bikemileage', 'nameCustomer','ProductsInfo', 'allworkOrders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'allwkcreatedat', 'machine_model', 'machine_brand', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems', 'totalExtraItemsVAT'));


        }

        else{

            // return "wk, products, extrasales";
            $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $request->id)->first();
            $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;

           // SELECT  * FROM totalextraitemsworkOrderId where workOrderId = 83;
        // only products
            $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();


        //infos da pagina processing
            $workOrderReference = $request->id;
            $machineId = $findWk->machine;
            $typeofpayment = $request->typeofpayment;
            $discount = $request->discount;
            $worklabor = $request->worklabor;

            // Amount total dos produtos (PREÇOS SEM VAT)
            $amountProducts = $findthisoverview->totalProductsonThisWk;
            // return $a= [$worklabor , $amountProducts , $totalExtraItemsWithoutVAT];
            $SubTotal = ($worklabor + $amountProducts + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
            $vat = ($SubTotal * 0.20);
            $subTotalWithVAT = ($SubTotal  + $vat);
            $total = $SubTotal - $discount; // total without vat
            $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
            $amoutwkwithoutprods = ((($worklabor + $totalExtraItemsWithoutVAT)  * 1.20) - $discount);


            $SubTotalFormated = number_format($SubTotal, 2, '.',',');
            $vat = number_format($vat, 2, '.',',');
            $discount = number_format($discount, 2, '.',',');
            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
            $amountProducts = number_format($amountProducts, 2, '.',',');
            $worklabor = number_format($worklabor, 2, '.',',');
            $totalExtraItemsStatus = "setup";
            $allextraitems = extraitems::where('workOrderId', 'LIKE', $id)->get();


            //endextraitems
            return view('sections.workOrder.previewqts.wkinvoice', compact('machine_info','mileage', 'bikemileage', 'nameCustomer','ProductsInfo', 'allworkOrders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'allwkcreatedat', 'machine_model', 'machine_brand', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems'));

        }
}



    public function showinvoice($id)
    {
        
            // return "show invoice recebendo o id $id";
            $findWkInvoice = workorder_invoice::find($id);
            $ThisWkInvoice = $findWkInvoice->id;

            $findWkInvoiceId = $findWkInvoice->workOrderReference;
            // find Work Order
            $findWk = workorder::find($findWkInvoiceId)->get();

            // id e quoteReference [e a mesma coisa no contexto ]
            $workOrderReference = $id;
            $newInvoiceId =  0;
            $newInvoiceCreatedDate =  date('d/m/Y');
            $invoicecreatedate =  $newInvoiceCreatedDate;
            $thisQuoteId = $id;

            // return $id;
            //pra achar o id da machine e outras infos do QUOTE
                // $findWk = workorder::find($findWkInvoiceId)->get()->first();
                $findWk = ( DB::select('SELECT * from work_order where  id =' . $findWkInvoiceId )[0]);
                $Machine_Id = $findWk->machine;
                $nameCustomer =  $findWk->customer;
                $product = $findWk->title;
                $customer_report = $findWk->customer_report;
                $last_observations = $findWk->last_observations;
                $bikemileage = ($findWk->mileage);
            //


            // Find all the customers data
            $findDatasCustomer = Customer::find($nameCustomer)->get()->first();
            $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
            $machine_model = ($machine_info->model);
            $machine_brand = ($machine_info->brand);
            $entry_machine_date = ($machine_info->created_at);
            $entry_machine_date =  date('d/m/Y', strtotime($entry_machine_date));


            $allworkOrdersCreatedAt =  date('d/m/Y', strtotime($machine_info->created_at));
            $allwkcreatedat =  $allworkOrdersCreatedAt;

            // acha as peças na maquina where o id da work order for a mesma q a workorder atual
            $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $findWkInvoiceId)->get();

            $ProductsInfo2 = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $findWkInvoiceId)->get();

            // infomações das work orders:whereRaw('machine = ' . $Machine_Id)->first();
            $Machine_Id;

            // $allworkOrders = allworkorderinformations::where('machineId', 'LIKE',  $Machine_Id)->first();

            $allworkOrders = allworkorderinformations::where('id', 'LIKE',  $findWkInvoiceId)->first();



            // dados dos campos que colocamos manualmente (discount, work labour)
            // E DADOS GERAIS

            // vendo a soma dos produtos nessa work Order
            $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $findWkInvoiceId)->first();

            if($findthisoverview != null || $findthisoverview != "")
            {
                $amountProducts = $findthisoverview->totalProductsonThisWk;
            }





            // GETTIN THESE INFORMATIONS FROM WORKORDER PAYMENTS
            $workorder_payments  = workorder_payments::where('workOrderReference', 'LIKE', $findWkInvoiceId)->first();
            $WkAmount = $workorder_payments->amount; // subtotal
            $WkMachine = $workorder_payments->machine;
            $WkTypeOfPayment = $workorder_payments->typeofpayment;
            $WkDiscount = $workorder_payments->discount;
            $WkWorkLabor = $workorder_payments->worklabor;

            $typeofpayment = $workorder_payments->typeofpayment;

            $worklabor = $workorder_payments->worklabor;
            $vat = $workorder_payments->vat;
            $amount = $workorder_payments->amount; // subtotal
            $discount = $workorder_payments->discount;
            $totalWithVAT = $workorder_payments->totalWithVAT;
            // $SubTotalFormated = $amount + $worklabor;


            // $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');
            // $vat = number_format($vat, 2, '.',',');
            // $amount = number_format($amount, 2, '.',',');
            // $discount = number_format($discount, 2, '.',',');
            // $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
            // $amountProducts = number_format($amountProducts, 2, '.',',');
            // $worklabor = number_format($worklabor, 2, '.',',');

        $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $findWkInvoiceId)->first();
        $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $findWkInvoiceId)->first();

         if($findthisoverview == "" || $findthisoverview == null ){
                // return "sem produto";

                    if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                    {
                            // somente o workorder

                            // $amountwithoutproducts = $SubTotalFormated; // AMOUNT É O SUBTOTAL

                            $worklabor = $workorder_payments->worklabor;
                            $vat = $workorder_payments->vat;
                            $amount = $workorder_payments->amount; // subtotal
                            $discount = $workorder_payments->discount;
                            $totalWithVAT = $workorder_payments->totalWithVAT;

                            $amountProducts = 0;
                            $amountwithoutproducts = 0;
                            $total = 0;


                            // $machineId = $request->machine;
                            // $typeofpayment = $request->typeofpayment;
                            // $discount = $request->discount;
                            // $workOrderReference = $request->id;
                            // $worklabor = $request->worklabor;

                            $vat = number_format($vat, 2, '.',',');
                            $amount = number_format($amount, 2, '.',',');
                            $discount = number_format($discount, 2, '.',',');
                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            $amountProducts = number_format($amountProducts, 2, '.',',');
                            $worklabor = number_format($worklabor, 2, '.',',');

                            $SubTotalFormated = $worklabor; // SOMANDO COM O TOTAL DOS VALORES EXTRAS
                            $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');

                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');


                            $totalExtraItemsStatus = "empty";
                            $onlyServiceMsg = "enabled";
                            $ProductsSatus = "empty";


                            return view('sections.workOrder.finalInvoice.wkinvoice', compact('bikemileage', 'nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate', 'workOrderReference', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments', 'Machine_Id', 'ThisWkInvoice', 'machine_model', 'machine_brand', 'allwkcreatedat', 'typeofpayment', 'worklabor', 'vat', 'amount', 'discount', 'totalWithVAT', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'onlyServiceMsg'));

                    }

                    else{


                            $amountProducts = 0;
                            $amountwithoutproducts = 0;
                            $total = 0;

                            // ONLY EXTRA ITEMS

                            // return "only extra items";
                            // se tiver algum produto com valor extra cadastrado
                            // $totalExtraItemsVAT = $findthisoverviewExtraItems->totalExtraItemsVAT;
                            $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;

                            $worklabor = $workorder_payments->worklabor;
                            $vat = $workorder_payments->vat;
                            $amount = $workorder_payments->amount; // subtotal
                            $discount = $workorder_payments->discount;
                            $totalWithVAT = $workorder_payments->totalWithVAT;

                            // return [$worklabor, $vat, $amount, $discount, $totalWithVAT];

                            // return $totalWithVAT = $findthisoverviewExtraItems->totalWithVAT + $totalExtraItemsVAT;
                            // $totalWithVAT = $workorder_payments->totalWithVAT + $totalExtraItemsVAT;



                            $workOrderId = $findthisoverviewExtraItems->workOrderId;

                            $SubTotalFormated = number_format($amount, 2, '.',',');
                            $totalExtraItemsWithoutVAT = number_format($totalExtraItemsWithoutVAT, 2, '.',',');
                            $vat = number_format($vat, 2, '.',',');
                            $amount = number_format($amount, 2, '.',',');
                            $discount = number_format($discount, 2, '.',',');
                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            $amountProducts = number_format($amountProducts, 2, '.',',');
                            $worklabor = number_format($worklabor, 2, '.',',');
                            $totalExtraItemsStatus = "setup";
                            $allextraitems = extraitems::where('workOrderId', 'LIKE', $findWkInvoiceId)->get ();
                             // indica que ta sem produtos
                            $ProductsSatus = "empty";


                            return view('sections.workOrder.finalInvoice.wkinvoice', compact('bikemileage', 'nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate', 'workOrderReference', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments', 'Machine_Id', 'ThisWkInvoice', 'machine_model', 'machine_brand', 'allwkcreatedat', 'typeofpayment', 'worklabor', 'vat', 'amount', 'discount', 'totalWithVAT', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'totalExtraItemsWithoutVAT', 'allextraitems'));


                }

            }


                // extraitems
                    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', 'LIKE', $findWkInvoiceId)->first();
                    if($findthisoverviewExtraItems == null){
                        // vat total *tirando os produtos que ja vieram com vat *

                        $SubTotalFormated = number_format($amount, 2, '.',','); // AMOUNT É O SUBTOTAL FORMATED
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($amount, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $amountProducts = number_format($amountProducts, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');


                        // quando  nao tiver extraitems vamos setar o valor para 0;
                        $totalExtraItemsVAT = 0;
                        $totalExtraItemsStatus = "empty";

                        $allextraitems = extraitems::where('workOrderId', 'LIKE', $findWkInvoiceId)->get ();


                        // return view('sections.workOrder.finalInvoice.wkinvoice', compact('nameCustomer', 'machine_name' ,'ProductsInfo', 'allworkOrders','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments'));
                        return view('sections.workOrder.finalInvoice.wkinvoice', compact('bikemileage', 'nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate', 'workOrderReference', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments', 'Machine_Id', 'ThisWkInvoice', 'machine_model', 'machine_brand', 'allwkcreatedat', 'typeofpayment', 'worklabor', 'vat', 'amount', 'discount', 'totalWithVAT', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems'));


                    }
                    else{


                        // EXTRASALES, PRODUCTS AND WORKORDERS
                        $worklabor = $workorder_payments->worklabor;
                        $vat = $workorder_payments->vat;
                        $amount = $workorder_payments->amount; // subtotal
                        $discount = $workorder_payments->discount;
                        $totalWithVAT = $workorder_payments->totalWithVAT;

                        // se tiver algum produto com valor extra cadastrado
                        $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;
                        // return $totalWithVAT = $findthisoverviewExtraItems->totalWithVAT + $totalExtraItemsVAT;


                        $workOrderId = $findthisoverviewExtraItems->workOrderId;

                        $SubTotalFormated = number_format($amount, 2, '.',',');
                        $totalExtraItemsWithoutVAT = number_format($totalExtraItemsWithoutVAT, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($amount, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $amountProducts = number_format($amountProducts, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');
                        $totalExtraItemsStatus = "setup";
                        $allextraitems = extraitems::where('workOrderId', 'LIKE', $findWkInvoiceId)->get ();
                        //endextraitems

                        // return view('sections.workOrder.finalInvoice.wkinvoice', compact('nameCustomer', 'machine_name' ,'ProductsInfo', 'allworkOrders','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'workOrderReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments'));
                        return view('sections.workOrder.finalInvoice.wkinvoice', compact('bikemileage', 'nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate', 'workOrderReference', 'findDatasCustomer', 'ProductsInfo2', 'workorder_payments', 'Machine_Id', 'ThisWkInvoice', 'machine_model', 'machine_brand', 'allwkcreatedat', 'typeofpayment', 'worklabor', 'vat', 'amount', 'discount', 'totalWithVAT', 'entry_machine_date', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems'));

            }

    }



    public function edit($id, $from = null, $updatingWarning = null)
    {

        // return $from;

        
        $allworkOrders = allworkorderinformations::find($id);

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        $opcoesMarcadas = array();
        $todosProdutos = array();
        $lista = DB::table('products')->get();
        $findProducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->get();
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();
        // products to show in dropdownbutton

            // todos os produtos referenciados à essa work order
            foreach($findProducts as $item){
              $opcoesMarcadas[] =  $item->product_id;
        }

            // todos produtos existentes na tabela products
            foreach($lista as $item){
            $todosProdutos[] =  $item->id;
        }


        // array com as respostas diferentes entre ambos outros arrays
        $array3 = array();
        foreach($todosProdutos as $produtos){
            // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
            if(!in_array($produtos, $opcoesMarcadas)){
                $array3[] =  $produtos;
            }
        }


        $max2 = sizeof($array3);
        if($max2 == 0  || $array3 == null)
        {
            $respostaProducts =0;
            $statusNulo = true;
        }

        else{

            for($i =0; $i < $max2; $i++){
                // return $uniao[$i];
                $allproducts2 = Product::find($array3[$i]);
                $respostaProducts[] =  $allproducts2;
                $statusNulo = false;
            }
        }




        if($from == null){
            $routeBack = "/section/workOrder/index";
        }
        else if($from == "MachineViewPage"){
            $allWK = allworkorderinformations::find($id);
            $machineId = $allWK->machineId;
            $routeBack = "/section/machines/viewPage/" .$machineId;
        }
        else if($from == "workOrderIndex"){
            $routeBack = "/section/workOrder/index";
        }
        else if($from == "customerworkOrderIndex"){
            $allWK = allworkorderinformations::find($id);
            $customerId = $allWK->customerId;
            $routeBack = "/section/workOrder/index/" . $customerId;
        }
        else if($from == "allinvoices"){
            $routeBack = "/section/allinvoices/index";
        }


        // escolhendo a quantidade dos produtos selecionados nessa ordem de serviço
        $workOrderReferenceId = $id;
        $ProductsSelected = overviewbetweenworkorderandproductsqts::whereRaw('pmwWorkReference = ' . $workOrderReferenceId)->get();
        $ExtraItems = extraitems::whereRaw('workOrderId = ' . $workOrderReferenceId)->get();




        return view('sections.workOrder.edit', compact('updatingWarning', 'routeBack','from', 'allworkOrders','allcustomers', 'allmachines', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'id' , 'ProductsSelected', 'ExtraItems', 'from'));
    }


    public function saveandAddQnt(Request $request){

        return "saveandAddQnt";

           // 'name', 'customer_report',  'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment'


           $id = $request->id;
           $workOrder = WorkOrder::find($id);
           if(isset($workOrder)){
           $workOrder->title = $request->title;
           $workOrder->customer_report = $request->customer_report;
           $workOrder->first_observations = $request->first_observations;
           $workOrder->last_observations = $request->last_observations;
           $workOrder->customer = $request->customer;
           $workOrder->machine = $request->machine;
           $workOrder->status = "1";
           $workOrder->typeofpayment = "none";
           $updateworkOrder = $workOrder->save();


           if($updateworkOrder){
               $workOrderReference = $id;
               $quoteReference = 0;
               $Productsoptions =  $request->Productsoptions;
               $MachineId = $workOrder->machine;
               $created_at = $workOrder->created_at;
               $updated_at = $workOrder->updated_at;

               $findDatasonRelationTable = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->first();

               if(!isset($Productsoptions)){
                   //se nenhum producto for selecionada, seja removida ou nao
                   if($findDatasonRelationTable){$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->delete();}

                //    return "nada";
               }


               if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
               // create
                   foreach ($Productsoptions as $key => $prodObj){
                   $vals = $request->Productsoptions;
                   $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                   }
               }

               else{
                   //update  ->delete and create
                   $deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->delete();
                   if($deleteproducts){
                       foreach ($Productsoptions as $key => $prodObj){
                           $vals = $request->Machinesoptions;
                           $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                       }
                }
            }
            $workOrderReferenceId = $id;
            $ProductsInfo = overviewbetweenworkorderandproductsqts ::whereRaw('workOrderReference = ' . $id)->get();

        }
    }

}



    public function confirmQuantity(Request $request){



        $productName =  $request->productName;
        $productQuantity =  $request->quantity;
        $workOrderId =  $request->id;
        $findwk = workorder::find($workOrderId);
        $MachineId = $findwk->machine;

        $productName =  $request->productName;
        $productQuantity =  $request->quantity;


        // inserindo quantidades
        $max2 = sizeof($productName);
        $max3 = sizeof($productQuantity);
        $quoteReference = $request->id;



        for($i=0; $i<$max2; $i++){
            // return $productQuantity[$prodName];
            DB::table('products_machines_workorders')
                ->where('workOrderReference', $quoteReference)
                ->where('product_id',  $productName[$i])
                ->update(['productQuantity' => $productQuantity[$i]]);
        }


        return redirect()
                    ->route('machine.viewPage', ['id' => $MachineId])
                    ->with('success',  'The Work Order was successful created');

    }



    public function destroy($id)
    {
        $deleteworkOrder = WorkOrder::find($id)->delete();
        {$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->delete();}
        {$deleteworkOrderPayments = workorder_payments::where('workOrderReference', 'LIKE', $id)->delete();}
        {$deleteworkorderinvoice = workorder_invoice::where('workOrderReference', 'LIKE', $id)->delete();}

        if($deleteworkOrder){
            return redirect()
                        ->back()
                        ->with('success',  'The Work Order was successful removed!' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }



    public function update(WorkOrderFormRequest $request, $id)
    {
            // return $id;


            $from =  $request->from;
            $status =  $request->status;

            $status =  $request->status;

            // $newStatusSelected =  $request->wkStatus;
            // $newStatusSelected == "WAITING FOR COLLECTION" ? $status =  2 : $status = 0;



            // for each to check with

            if($request->wkservice == 'NaN' || $request->wkservice == null || $request->discount == 'NaN' || $request->discount == null){
                return redirect()
                ->back()
                ->with('warning',  'You must add a valid value for the service and discount' );
            }


            // pegando nome dos produtos utilizados nessa ordem de serviço e suas quantidades
            $discount =  $request->discount;
            $wkservice =  $request->wkservice;

            // 'name', 'customer_report',  'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment'

            $workOrder = WorkOrder::find($id);
            if(isset($workOrder)){
            $workOrder->title = $request->input('title');
            $workOrder->customer_report = $request->input('customer_report');
            $workOrder->last_observations = $request->input('last_observations');
            $workOrder->customer = $request->input('customer');
            $workOrder->machine = $request->input('machine');
            $workOrder->status = $status;
            $workOrder->discount = $discount;
            $workOrder->worklabor = $wkservice;
            $workOrder->mileage =  $request->input('mileage');
            $workOrder->typeofpayment = "none";
            $updateworkOrder = $workOrder->save();

            $machine_id = $workOrder->machine;
            if($updateworkOrder){
                // extraitems
                        // machines selected
                        $DescriptionName =  $request->DescriptionName;
                        // $Sell_Price =  $request->Sell_Price;
                        $Sell_PriceVat =  $request->Sell_PriceVat;
                        $findDatasonRelationTableExtraItems = extraitems::where('workOrderId', 'LIKE', $id)->first();


                        if(!isset($DescriptionName)){
                            //se nenhum extraitem  for adicionado, seja removida ou nao
                            $deleteproducts = extraitems::where('workOrderId', 'LIKE', $id)->delete();
                        }

                        else if($findDatasonRelationTableExtraItems == null || $findDatasonRelationTableExtraItems == "")
                        {
                                $max4 = sizeof($DescriptionName);
                                for($i =0; $i < $max4; $i++)
                                {
                                    $vals = $request->Sell_Price;
                                    // $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);
                                    // 'name', 'Sell_Price', 'Sell_PriceVat', 'about', 'condition', 'quoteId', 'workOrderId'
                                    $createExtraItems = new extraitems();
                                    $createExtraItems->name = $DescriptionName[$i];
                                    $createExtraItems->Sell_Price = ($Sell_PriceVat[$i] / 1.20);
                                    $createExtraItems->Sell_PriceVat = $Sell_PriceVat[$i];
                                    $createExtraItems->about = "extrasales";
                                    $createExtraItems->condition = "extra";
                                    $createExtraItems->quoteId = 0;
                                    $createExtraItems->workOrderId = $id;
                                    $updateExtraItems = $createExtraItems->save();
                                }
                        }

                        else if(isset($DescriptionName)){
                            $deleteextraitems = extraitems::where('workOrderId', 'LIKE', $id)->delete();
                            if($deleteextraitems){
                                $max4 = sizeof($DescriptionName);
                                    for($i =0; $i < $max4; $i++)
                                    {
                                        $vals = $request->Sell_Price;
                                        // $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);
                                        // 'name', 'Sell_Price', 'Sell_PriceVat', 'about', 'condition', 'quoteId', 'workOrderId'
                                        $createExtraItems = new extraitems();
                                        $createExtraItems->name = $DescriptionName[$i];
                                        $createExtraItems->Sell_Price = ($Sell_PriceVat[$i] / 1.20);
                                        $createExtraItems->Sell_PriceVat = $Sell_PriceVat[$i];
                                        $createExtraItems->about = "extrasales";
                                        $createExtraItems->condition = "extra";
                                        $createExtraItems->quoteId = 0;
                                        $createExtraItems->workOrderId = $id;
                                        $updateExtraItems = $createExtraItems->save();
                                    }
                        }
                    }

                //fim extraitems

                $workOrderReference = $id;
                $quoteReference = 0;
                $Productsoptions =  $request->Productsoptions;
                $MachineId = $workOrder->machine;
                $created_at = $workOrder->created_at;
                $updated_at = $workOrder->updated_at;

                $findDatasonRelationTable = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->first();

                if(!isset($Productsoptions)){
                    $addQuantitiesSection  = false;
                    //se nenhum producto for selecionada, seja removida ou nao
                    if($findDatasonRelationTable){$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->delete();}

                            if($from == null)
                            {
                                return redirect()
                                            ->route('machine.viewPage', ['id' => $MachineId])
                                            ->with('success',  'The Work Order was successfull updated!' );
                            }
                            else if($from == "workOrderIndex"){
                                return redirect()
                                            ->route('workOrder.index')
                                            ->with('success',  'The Work Order was successfull updated!' );
                            }
                            else if ($from == "MachineViewPage") {
                                return redirect()
                                            ->route('machine.viewPage', ['id' => $MachineId])
                                            ->with('success',  'The Work Order was successfull updated!' );
                            }
                            else{
                                return redirect()
                                            ->route('workOrder.index', ['id' => $workOrder->customer])
                                            ->with('success',  'The Work Order was successfull updated!' );
                            }
                }


                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // CASO SEJA A PRIMEIRO ITEM A SER ADICIONADO ANTES NAO TINHA NADA, AGORA TEM 1 OU MAIS OPÇÕES
                    // create

                    $addQuantitiesSection  = true;
                    $updatingWarning = true;

                    $productQuantity = 1 ; // valor padrao
                    foreach ($Productsoptions as $key => $prodObj){
                    $vals = $request->Productsoptions;

                    $productsInfos = Product::find($prodObj);
                    $productName = $productsInfos->name;
                    $image = $productsInfos->image;
                    $SKU = $productsInfos->SKU;
                    $brand = $productsInfos->brand;
                    $Sell_PriceVat = $productsInfos->Sell_PriceVat;
                    $Sell_Price = $productsInfos->Sell_Price;
                    $Cost_Price = $productsInfos->Cost_Price;
                    $condition = $productsInfos->condition;
                    $supplier = $productsInfos->supplier;


                    $createWorkOrder = new products_machines_workorders();
                    $createWorkOrder->machine_id = $machine_id;
                    $createWorkOrder->product_id = $prodObj;
                    $createWorkOrder->productName = $productName;
                    $createWorkOrder->image = $image;
                    $createWorkOrder->SKU = $SKU;
                    $createWorkOrder->brand = $brand;
                    $createWorkOrder->workOrderReference = $workOrderReference;
                    $createWorkOrder->productQuantity = $productQuantity;
                    $createWorkOrder->quoteReference = $quoteReference;
                    $createWorkOrder->Sell_PriceVat = $Sell_PriceVat;
                    $createWorkOrder->Sell_Price = $Sell_Price;
                    $createWorkOrder->Cost_Price = $Cost_Price;
                    $createWorkOrder->condition = $condition;
                    $createWorkOrder->supplier = $supplier;
                    $createWorkOrder->created_at = $created_at;
                    $createWorkOrder->updated_at = $updated_at;
                    $updateProd12 = $createWorkOrder->save();

                    // $product_machine = DB::insert(`insert into products_machines_workorders (machine_id, product_id, productName,image, SKU,brand, workOrderReference, quoteReference,Sell_PriceVat, Sell_Price,Cost_Price, condition, supplier) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`, [$machine_id, $prodObj, $productName, $image, $SKU, $brand, $workOrderReference, $quoteReference, $Sell_PriceVat, $Sell_Price, $Cost_Price, $condition, $supplier]);
                    }
                }

                else{

                    //update  ->delete and create

                    // return $request;

                    $Productsoptions =  $request->Productsoptions; // produtos selecionados agora
                    $productName =  $request->productName; // products ja selecionados anteriormente

                    if($Productsoptions == "" || $Productsoptions == null || $productName == "" || $productName == null)
                    {
                        return redirect()
                        ->with('danger',  'Something wrong happened, please try again.' );
                    }



                    // checando se algo diferente foi inserido ou somente atualizado sem nenhum dado diferente
                    $array3 = array();
                    foreach($Productsoptions as $prodsopt){
                        // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
                        if(!in_array($prodsopt, $productName)){
                            $array3[] =  $prodsopt;
                        }
                    }

                    if ($array3 == null || $array3 == "[]"){
                        // return 4;
                        // nothing new was added
                        $addQuantitiesSection  = false;
                        $updatingWarning = false;
                    }
                    else {
                        // return 5;
                        // nothing new was added
                        $addQuantitiesSection  = true;
                        $updatingWarning = true;
                    }



                    $productQuantity = 1 ; // valor padrao
                    $deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', $id)->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){
                            $vals = $request->Machinesoptions;


                            $productsInfos = Product::find($prodObj);
                            $productName = $productsInfos->name;
                            $image = $productsInfos->image;
                            $SKU = $productsInfos->SKU;
                            $brand = $productsInfos->brand;
                            $Sell_PriceVat = $productsInfos->Sell_PriceVat;
                            $Sell_Price = $productsInfos->Sell_Price;
                            $Cost_Price = $productsInfos->Cost_Price;
                            $condition = $productsInfos->condition;
                            $supplier = $productsInfos->supplier;

                            $createWorkOrder = new products_machines_workorders();
                            $createWorkOrder->machine_id = $machine_id;
                            $createWorkOrder->product_id = $prodObj;
                            $createWorkOrder->productName = $productName;
                            $createWorkOrder->image = $image;
                            $createWorkOrder->SKU = $SKU;
                            $createWorkOrder->brand = $brand;
                            $createWorkOrder->workOrderReference = $workOrderReference;
                            $createWorkOrder->quoteReference = $quoteReference;
                            $createWorkOrder->productQuantity = $productQuantity;
                            $createWorkOrder->Sell_PriceVat = $Sell_PriceVat;
                            $createWorkOrder->Sell_Price = $Sell_Price;
                            $createWorkOrder->Cost_Price = $Cost_Price;
                            $createWorkOrder->condition = $condition;
                            $createWorkOrder->supplier = $supplier;
                            $createWorkOrder->created_at = $created_at;
                            $createWorkOrder->updated_at = $updated_at;
                            $updateProd12 = $createWorkOrder->save();
                            // $product_machine = DB::insert('insert into products_machines_workorders (machine_id, product_id, productName,image, SKU,brand, workOrderReference, quoteReference,Sell_PriceVat, Sell_Price,Cost_Price, condition, supplier) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$machine_id, $prodObj, $productName, $image, $SKU, $brand, $workOrderReference, $quoteReference, $Sell_PriceVat, $Sell_Price, $Cost_Price, $condition, $supplier]);
                        }


                    // return $productQuantity;
                    $productName =  $request->productName;
                    $productQuantity =  $request->quantity;
                    // inserindo quantidades
                    $max2 = sizeof($productName);
                    $max3 = sizeof($productQuantity);
                    $workOrderReference = $id;
                    for($i=0; $i<$max2; $i++){
                        // return $productQuantity[$prodName];
                        DB::table('products_machines_workorders')
                            ->where('workOrderReference', $workOrderReference)
                            ->where('product_id',  $productName[$i])
                            ->update(['productQuantity' => $productQuantity[$i]]);

                        // $productsAndQuantities[] =  $productName[$i]. " and" . " quantity " . $productQuantity[$i];
                    }
              }

            }



            if($addQuantitiesSection == false)
            {

                // checando de onde veio

                if($from == null)
                {
                        return redirect()
                                   ->route('machine.viewPage', ['id' => $MachineId])
                                   ->with('success',  'The Work Order was successfull updated!' );
                }
                else if ($from == "workOrderIndex") {
                        return redirect()
                                    ->route('workOrder.index')
                                    ->with('success',  'The Work Order was successfull updated!' );
                }
                else if ($from == "MachineViewPage") {
                        return redirect()
                                    ->route('machine.viewPage', ['id' => $MachineId])
                                    ->with('success',  'The Work Order was successfull updated!' );
                }
                else if ($from == "customerMachineViewPage") {
                        return redirect()
                                    ->route('workOrder.index')
                                    ->with('success',  'The Work Order was successfull updated!' );
                }
                else{
                        return redirect()
                                    ->route('machine.viewPage', ['id' => $MachineId])
                                    ->with('success',  'The Work Order  was successfull updated!' );
                }


            }
            
            else{
                            if($from == null)
                            {
                                $from = "customerworkOrderIndex";
                            }
                            else
                            {
                                $from = $from;
                            }
                            // return$from == "customerworkOrderIndex" ? $from =  "customerworkOrderIndex" : $from = "MachineViewPage";

                            return redirect()
                            ->route('workOrder.edit', ['id' => $id, 'from' => $from, 'updatingWarning' => $updatingWarning]);
                }
            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }


    public function updateInvoiceAjax(Request $request)
    {

        $discountValue = $request->discountValue;
        $worklaborValue = $request->worklaborValue;
        $workOrderReference = $request->workOrderReference;
        $typeofpayment = $request->typeofpayment;
        $lastObservationsinput = $request->lastObservationsinput;
        $mileage = $request->mileage;


        $updateWorkOrder = WorkOrder::find($workOrderReference);
        if(isset($updateWorkOrder)){
            $updateWorkOrder->discount = $discountValue;
            $updateWorkOrder->worklabor = $worklaborValue;
            $updateWorkOrder->typeofpayment = $typeofpayment;
            $updateWorkOrder->last_observations = $lastObservationsinput;
            $updateWorkOrder->mileage = $mileage;
            $updateThisWorkOrder = $updateWorkOrder->save();
        }
        return $workOrderReference;
    }


    public function jobCart($id, $from = null)
    {

        $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $id)->get();

        // if ($ProductsInfo == "[]" ){
        //     return redirect()
        //     ->back()
        //     ->with('warning',  'You cannot see this previous invoice because there is no Product on this Work Order' );
        // }

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
        return view('sections.workOrder.jobCart', compact('allworkOrders','allcustomers', 'allmachines','id', 'ProductsInfo',
          'from', 'ExtraItems', 'id'));

    }


    public function printjobCart(Request $request)
    {

        $wkId = $request->wkId;

        $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', 'LIKE', $wkId)->get();

        $machineId = $request->machineId;
        $customerName = $request->customerName;

        $allcustomers = Customer::find($customerName);
        $allmachines = Machine::find($machineId);

        $title = $request->title;
        $jobDescription = $request->jobDescription;

        return view('sections.workOrder.jobCartPrinter', compact('title','jobDescription', 'allcustomers', 'allmachines', 'machineId', 'ProductsInfo', 'wkId'));
    }

    public function getWKAjaxByMachine(Request $request)
    {
        $id = $request->machineId;
        $allworkOrders = allworkorderinformations::where('machineId' , '=',  $id)->where('status', '!=', '1')->get();

        if($allworkOrders == "[]" || $allworkOrders == null || $allworkOrders == [])
        {
            return 0;
        }
        else
        {
            return $allworkOrders;
        }

    }

    public function allworkorderAjaxByMachine(Request $request)
    {
        // $allworkOrders = allworkorderinformations::all();

        $id = $request->machineId;


        $allworkOrders = allworkorderinformations::where('machineId', 'LIKE', $id)->where('status', 1)->get();

        return $allworkOrders;
    }


    public function finishWK($id){
        
        if($id == null || $id == 0)
        {
            return redirect()
            ->back();
        }
        else{

            //  FAZENDO O UPDATE NO STATUS DA WORK ORDER, ATUALIZANDO TAMBEM OS OUTROS VALORES E REALIZANDO A INSERÇÃO NA TABELA WORKORDER_PAYMENTS
           $findWorkOrder = WorkOrder::find($id);
           $machineId = $findWorkOrder->machine;


            if($findWorkOrder) {
                $findWorkOrder->status = 1;
                $updatemachines = $findWorkOrder->save();
            }


            // Route::get('/section/machines/viewPage/{id}', 'MachinesController@viewPage')->name('machine.viewPage');

            return redirect()
                ->route('machine.viewPage', ['id' => $machineId]);

        }
    }


    
}
