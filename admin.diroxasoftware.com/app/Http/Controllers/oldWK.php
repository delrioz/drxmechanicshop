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
use App\workorder_payments;
use App\workorder_invoice;
use App\quotepreviewinvoice;
use App\totalprodsSelectedQuote;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function OpenWorkOrder(Request $request)
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
                    'first_observations' => $first_observations,
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
            'product' => $product,'dataConfirmPay' => $dataConfirmPay, 'customer_report' => $customer_report, 'first_observations' => $first_observations,
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



    public function index()
    {
        // $allworkOrders = allworkorderinformations::all();
        $allworkOrders = allworkorderinformations::where('status', '0')->get();

        return view('sections.workOrder.index', compact('allworkOrders'));    
    }

    public function allworkorder()
    {

        // $allworkOrders = allworkorderinformations::all();
        $allworkOrders = allworkorderinformations::where('status', '1')->get();

        return view('sections.workOrder.allworkorder', compact('allworkOrders'));  

    }

    public function create()
    {
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();


        return view('sections.workOrder.create', compact('allcustomers', 'allmachines', 'allproducts'));
    }

    public function store(WorkOrderFormRequest $request)
    {   

        $request->title == null ? $title =  'No title' : $title = $request->title;
        $request->last_observations == null ? $last_observations =  'No last_observations' : $last_observations = $request->last_observations;


        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);
        $customer_report = $allmachines->customer_report;


        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $createWorkOrder = new WorkOrder();
        $createWorkOrder->title = $title;
        $createWorkOrder->customer_report = $allmachines->customer_report;
        $createWorkOrder->first_observations = $allmachines->first_observations;
        $createWorkOrder->last_observations = $last_observations;
        $createWorkOrder->customer = $allmachines->owner;
        $createWorkOrder->machine = $request->input('machine');
        $createWorkOrder->status = $request->input('status');
        $createWorkOrder->status = $request->input('status');
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

                $createWorkOrder = new products_machines_workorders();
                $createWorkOrder->machine_id = $machine_id;
                $createWorkOrder->product_id = $ProdObj;
                $createWorkOrder->workOrderReference = $workOrderReference;
                $createWorkOrder->quoteReference = $quoteReference;
                $createWorkOrder->created_at = $created_at;
                $createWorkOrder->updated_at = $updated_at;
                $createWorkOrder->productQuantity = 1;
                $updateProd12 = $createWorkOrder->save();
               }
  
            }


                    // se algum produto foi selecionado
        if($request->Productsoptions){
            return redirect()->route('wk.chooseQuantity', ['id' => $thiswkId]);
        }
        else{
            return redirect()
            ->route('workOrder.index')
            ->with('success',  'The Work Order was successful created !' );
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
        $findProducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->get(); 

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
        $ProductsInfo  = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->get(); 
        
        if ($ProductsInfo != '[]'){
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

        return view('sections.workOrder.addingQuantities', compact('allwk', 'allcustomers', 'allmachines','name', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'ProductsInfo', 'id', 'productsonthisWorkOrder', 'statusNulo2'));

}




    public function edit($id)
    {
        $allworkOrders = allworkorderinformations::find($id);
       
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();
        
        $opcoesMarcadas = array();
        $todosProdutos = array();
        $lista = DB::table('products')->get();
        $findProducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->get(); 
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


        // end products

        // products in this actual quote
    //       $ProductsInfo  = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->get(); 
         
    //     if ($ProductsInfo != '[]'){
    //     // add a um array todos os ids de produtos encontrados nessa ordem de serviço
    //     foreach($ProductsInfo as $item){
    //         $ProductsInfoIds[] =  $item->product_id;
    //     }

    //     // com esse array de ids vou fazer um foreach para buscar cada um desses itens na tabela produtos e me retornar tudo sobre ele naquela posição
    //     $max4 = sizeof($ProductsInfoIds);
    //     if($max4 != 0)
    //     {
    //         for($i =0; $i < $max4; $i++){
    //             $allproducsbyworkorders  = overviewbetweenworkorderandproductsqts::where('pmwWorkReference', 'LIKE', "%{$id}%")->get(); 
    //             $productsonthisWorkOrder =  $allproducsbyworkorders;
    //             $statusNulo2 = true;
    //         }
    //     }
    // }

    // else{
    //         $productsonthisWorkOrder =0;
    //         $statusNulo2 = false;
    //     }
        



        // escolhendo a quantidade dos produtos selecionados nessa ordem de serviço
         $workOrderReferenceId = $id;
         $ProductsSelected = overviewbetweenworkorderandproductsqts::whereRaw('pmwWorkReference = ' . $workOrderReferenceId)->get();

        return view('sections.workOrder.edit', compact('allworkOrders','allcustomers', 'allmachines', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'id' , 'ProductsSelected'));
    }


    public function saveandAddQnt(Request $request){

        return "saveandAddQnt";
        
           // 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment'

           
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
   
               $findDatasonRelationTable = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->first();
   
               if(!isset($Productsoptions)){
                   //se nenhum producto for selecionada, seja removida ou nao 
                   if($findDatasonRelationTable){$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
                   
                   return "nada";
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
                   $deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();
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


    

    public function destroy($id)
    {
        $deleteworkOrder = WorkOrder::find($id)->delete();
        {$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
        {$deleteworkOrderPayments = workorder_payments::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
        {$deleteworkorderinvoice = workorder_invoice::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}

        if($deleteworkOrder){
            return redirect()
                        ->route('workOrder.index')
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

            // pegando nome dos produtos utilizados nessa ordem de serviço e suas quantidades
            


        // 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment'

            $workOrder = WorkOrder::find($id);
            if(isset($workOrder)){
            $workOrder->title = $request->input('title');
            $workOrder->customer_report = $request->input('customer_report');
            $workOrder->first_observations = $request->input('first_observations');
            $workOrder->last_observations = $request->input('last_observations');
            $workOrder->customer = $request->input('customer');
            $workOrder->machine = $request->input('machine');
            $workOrder->status = "0";
            $workOrder->typeofpayment = "none";
            $updateworkOrder = $workOrder->save();

            if($updateworkOrder){

                $workOrderReference = $id;
                $quoteReference = 0;
                $Productsoptions =  $request->Productsoptions;
                $MachineId = $workOrder->machine;
                $created_at = $workOrder->created_at;
                $updated_at = $workOrder->updated_at;
    
                $findDatasonRelationTable = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->first();
    
                if(!isset($Productsoptions)){
                    //se nenhum producto for selecionada, seja removida ou nao 
                    if($findDatasonRelationTable){$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
                    
                    return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The Work Order was successfull updated!' );
                }
                
    
                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // createAY
                    $productQuantity = 1 ; // valor padrao
                    foreach ($Productsoptions as $key => $prodObj){  
                    $vals = $request->Productsoptions;
                    $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, productQuantity, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $productQuantity, $created_at, $updated_at]);
                    }
                }
    
                else{
                    //update  ->delete and create 
                    $productQuantity = 1 ; // valor padrao
                    $deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){  
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, productQuantity, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $productQuantity, $created_at, $updated_at]);
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

            return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The Work Order was successful updated' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }
}