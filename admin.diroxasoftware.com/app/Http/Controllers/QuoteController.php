<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quote;
use App\Customer;
use App\Machine;
use App\allquotesinformations;
use App\products_machines_workorders;
use App\Product;
use App\products_machines_quotes;
use App\productsclientsmachinesallinfos;
use App\overviewquotesandproducts;
use DB;
use App\Http\Requests\Customer\QuoteFormRequest;
use App\Http\Requests\Customer\QuoteCreateFormRequest;
use App\quotepreviewinvoice;
use App\workorder_invoice;
use App\totalprodsSelectedQuote;
use App\totalprodsSelectedWK;
use App\extraitems;
use App\totalextraitems;
use App\totalextraitemsquoteId;

class QuoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // status 0 means active

        $allQuotes = allquotesinformations::where('status' , '!=', '1')->get();
        if($allQuotes == "[]"){
            
            return view('sections.quote.indexsemdata', compact('allQuotes'));
        }
        else{
            return view('sections.quote.index', compact('allQuotes'));
        }


    }

    public function create($id = null)
    {
        if($id == null){
                $allcustomers = Customer::all();
                $allmachines = Machine::all();
                $allproducts = Product::all();
                $routeBack = "indexPage";
                return view('sections.quote.create', compact('allmachines', 'allproducts','routeBack', 'id'));
        }
        else{
                $allmachines = Machine::find($id);

                if($allmachines == "")
                {
                    $allcustomers = Customer::all();
                    $allmachines = Machine::all();
                    $allproducts = Product::all();
                    $routeBack = "indexPage";
                    return view('sections.quote.create', compact('allcustomers', 'allmachines', 'allproducts','routeBack', 'id'));
                }
                
                if($id == "welcomePage"){
                        $allcustomers = Customer::all();
                        $allmachines = Machine::find($id);
                        $allproducts = Product::all();
                        $routeBack = "welcomePage";
                        $isMachineID = true;
                        return view('sections.quote.create', compact('allcustomers', 'allmachines', 'allproducts', 'routeBack', 'id', 'isMachineID'));
                }
                else{
                        $allcustomers = Customer::all();
                        $allmachines = Machine::find($id);
                        $allproducts = Product::all();
                        $routeBack = "machineViewPage";
                        $isMachineID = true;
                        return view('sections.quote.create', compact('allcustomers', 'allmachines', 'allproducts', 'routeBack', 'id', 'isMachineID'));
                }
        }
    }

    public function store(QuoteCreateFormRequest $request)
    {

        if($request->wkservice == 'NaN' || $request->wkservice == null || $request->discount == 'NaN' || $request->discount == null){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }


        $machine =  $request->machine;
        if($machine == null){
            return redirect()
            ->back()
            ->with('warning',  'You cannot create this Quote  because there is no Machine Selected' );
        }

        $discount =  $request->discount;
        $wkservice =  $request->wkservice;
        $request->title == null ? $title =  'No title' : $title = $request->title;
        $request->last_observations == null ? $last_observations =  'No last_observations' : $last_observations = $request->last_observations;

        // return $request;
        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);
        $customer_report = $allmachines->customer_report;


        // 'title', 'customer_report',  'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $customer_report=  $request->customer_report;
        $customer_report== null ? $customer_report =  'No customer report' : $$customer_report = $customer_report;

        $createQuote = new Quote();
        $createQuote->title = $title;
        $createQuote->customer_report = $customer_report;
        $createQuote->last_observations = $last_observations;
        $createQuote->customer = $allmachines->owner;
        $createQuote->machine = $request->input('machine');
        $createQuote->status = $request->input('status');
        $createQuote->wkservice = $wkservice;
        $createQuote->discount = $discount;
        $createQuote->mileage =  $allmachines->mileage;
        $updateProd = $createQuote->save();
        $idQuote = $createQuote->id;



        if($updateProd){
        // machines selected
        $Productsoptions =  $request->Productsoptions;
        $machineId = $createQuote->machine;
        // $productId = $createQuote->product;
        $quoteReference = $createQuote->id;
        $created_at = $createQuote->created_at;
        $updated_at = $createQuote->updated_at;

        if($Productsoptions){
            // verificando se tem algum produto selecionado
            foreach ($Productsoptions as $key => $ProdObj)
            {
            $vals = $request->Productsoptions;
            // $product_machine_inster = DB::insert('insert into products_machines_quotes (machine_id, product_id, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?)', [$machineId, $ProdObj, $quoteReference, $created_at, $updated_at]);

            $createQuote = new products_machines_quotes();
            $createQuote->machine_id = $machine_id;
            $createQuote->product_id = $ProdObj;
            $createQuote->quoteReference = $quoteReference;
            $createQuote->created_at = $created_at;
            $createQuote->updated_at = $updated_at;
            $createQuote->productQuantity = 1;
            $updateProd12 = $createQuote->save();

           }
        }

        // machines selected
        $DescriptionName =  $request->DescriptionName;

        //valor que é fornecido
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
                $createExtraItems->quoteId = $idQuote;
                $createExtraItems->workOrderId = 0;
                $updateExtraItems = $createExtraItems->save();

            }
        }
    }

    else{

        return redirect()
        ->back()
        ->with('error', $response['message']);

    }
        // quando tudo for feito vai retornar para uma tela de exibição para o mesmo escolher as quantitdades dos produtos

        $thisQuoteId = $createQuote->quoteReference;

        // se algum produto foi selecionado
        if($request->Productsoptions){
            return redirect()->route('quote.chooseQuantity', ['id' => $thisQuoteId]);
        }
        else{
            return redirect()
                        ->route('machine.viewPage', ['id' => $machineId])
                        ->with('success',  'The Quote was successful created');
        }


    }


    public function chooseQuantity(Request $request){

        
        $id = $request->id; 
        $allQuotes = allquotesinformations::find($id);
        // name of the customer
        $name = $allQuotes->customerId;

        // name of the machine

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        // all products
        $lista = DB::table('products')->get();
        // this actual quote
        $findProducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();

        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id do quote atual
        $outrasop = productsclientsmachinesallinfos::where('quoteReference', 'LIKE', $id)->get();

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
         $ProductsInfo  = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();

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

        return view('sections.quote.addingQuantities', compact('allQuotes', 'allcustomers', 'allmachines','name', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'ProductsInfo', 'id', 'productsonthisWorkOrder', 'statusNulo2'));
    }


    public function edit($id, $from = null, $updatingWarning = null)
    {


        $allQuotes = allquotesinformations::find($id);
        $thisQuoteStatus =  $allQuotes->status;
        // name of the customer
        $name = $allQuotes->customerId;

        // name of the machine

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        // all products
        $lista = DB::table('products')->get();
        // this actual quote
        $findProducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->get();

        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id do quote atual
        $outrasop = productsclientsmachinesallinfos::where('quoteReference', 'LIKE', $id)->get();


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


        if($from == null){
            $routeBack = "/section/quote/";
        }
        else if($from == "MachineViewPage"){
            $allQuotes = allquotesinformations::find($id);
            $machineId = $allQuotes->machineId;
            $routeBack = "/section/machines/viewPage/" .$machineId;
        }

        $statusNulo2 = false;

            // escolhendo a quantidade dos produtos selecionados nessa ordem de serviço
        $quoteReferenceId = $id;
        $ProductsSelected = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReferenceId)->get();
        $ExtraItems = extraitems::whereRaw('quoteId = ' . $quoteReferenceId)->get();

        return view('sections.quote.edit', compact('updatingWarning', 'routeBack', 'from', 'allQuotes', 'allcustomers', 'allmachines','name', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'statusNulo2', 'ProductsSelected', 'ExtraItems', 'thisQuoteStatus'));
}


    public function destroy($id)
    {
        $deletequote = Quote::find($id)->delete();
       {$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->delete();}
       {$deletequotepreviewinvoice = quotepreviewinvoice::where('quoteReference', 'LIKE', $id)->delete();}

        if($deletequote){
            return redirect()
                        ->back()
                        ->with('success',  'The Quote was successful deleted');
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }



    public function confirmQuantity(Request $request)
    {
            
            $productName =  $request->productName;
            $productQuantity =  $request->quantity;
            $quoteId =  $request->id;
            $findQuote = Quote::find($quoteId);
            $MachineId = $findQuote->machine;

            $productName =  $request->productName;
            $productQuantity =  $request->quantity;
            // inserindo quantidades
            $max2 = sizeof($productName);
            $max3 = sizeof($productQuantity);
            $quoteReference = $request->id;

            for($i=0; $i<$max2; $i++){
                // return $productQuantity[$prodName];
                DB::table('products_machines_quotes')
                    ->where('quoteReference', $quoteReference)
                    ->where('product_id',  $productName[$i])
                    ->update(['productQuantity' => $productQuantity[$i]]);
            }


            return redirect()
                        ->route('machine.viewPage', ['id' => $MachineId])
                        ->with('success',  'The Quote was successful created');

 }


    public function update(QuoteFormRequest $request, $id)
    {   

        if($request->wkservice == 'NaN' || $request->wkservice == null || $request->discount == 'NaN' || $request->discount == null
        || $request->status == 'NaN' || $request->status == null){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }

        // 'title', 'customer_report',  'last_observations', 'customer', 'machine', 'status', 'typeofpayment'
        $wkservice =  $request->wkservice;
        $discount =  $request->discount;
        $status =  $request->status;

        $newStatusSelected =  $request->quotesStatus;
        $newStatusSelected == "REFUSED" ? $status =  3 : $status = 0;


            $quote = Quote::find($id);
            if(isset($quote)){
            $quote->title = $request->input('title');
            $quote->customer_report = $request->input('customer_report');
            $quote->last_observations = $request->input('last_observations');
            $quote->customer = $request->input('customer');
            $quote->machine = $request->input('machine');
            $quote->mileage = $request->input('mileage');
            $quote->wkservice = $request->wkservice;
            $quote->discount = $request->discount;
            $quote->status = $status;
            $updatequote = $quote->save();

            if($updatequote)
            {
                // extraitems
                        // machines selected
                        $DescriptionName =  $request->DescriptionName;
                        // $Sell_Price =  $request->Sell_Price;
                        $Sell_PriceVat =  $request->Sell_PriceVat;
                        $findDatasonRelationTableExtraItems = extraitems::where('quoteId', 'LIKE', $id)->first();


                        if(!isset($DescriptionName)){
                            //se nenhum extraitem  for adicionado, seja removida ou nao
                            $deleteproducts = extraitems::where('quoteId', 'LIKE', $id)->delete();
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
                                    $createExtraItems->quoteId = $id;
                                    $createExtraItems->workOrderId = 0;
                                    $updateExtraItems = $createExtraItems->save();
                                }
                        }

                        else if(isset($DescriptionName)){

                            $deleteextraitems = extraitems::where('quoteId', 'LIKE', $id)->delete();
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
                                        $createExtraItems->quoteId = $id;
                                        $createExtraItems->workOrderId = 0;
                                        $updateExtraItems = $createExtraItems->save();
                                    }
                        }
                    }

                //fim extraitems


                //products normais
                $quoteReference = $id;
                $Productsoptions =  $request->Productsoptions;
                $MachineId = $quote->machine;
                $created_at = $quote->created_at;
                $updated_at = $quote->updated_at;
                $findDatasonRelationTable = products_machines_quotes::where('quoteReference', 'LIKE', $id)->first();



                if(!isset($Productsoptions)){
                    $addQuantitiesSection  = false;
                    //se nenhum producto for selecionada, seja removida ou nao
                    if($findDatasonRelationTable){$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->delete();}
                    return redirect()
                                    ->route('machine.viewPage', ['id' => $MachineId])
                                    ->with('success',  'The Quote was successful updated');
                }


                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                        // create
                        $addQuantitiesSection  = true;
                        $updatingWarning = true;

                        foreach ($Productsoptions as $key => $prodObj){
                        $productQuantity = 1 ; // valor padrao
                        $vals = $request->Productsoptions;
                        $product_machine = DB::insert('insert into products_machines_quotes (quoteReference, machine_id, product_id, productQuantity, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$quoteReference, $MachineId, $prodObj, $productQuantity, $created_at, $updated_at]);
                    }
                }

                else{

                    $Productsoptions =  $request->Productsoptions; // produtos selecionados agora
                    $productName =  $request->productName; // products ja selecionados anteriormente

                    // checando se algo diferente foi inserido ou somente atualizado sem nenhum dado diferente
                    $array3 = array();
                    foreach($Productsoptions as $prodsopt){
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

                    //update  ->delete and create
                    $productQuantity = 1 ; // valor padrao
                    $deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines_quotes (quoteReference, machine_id, product_id, productQuantity, created_at, updated_at) values (?, ?, ?, ?,  ?, ?)', [$quoteReference, $MachineId, $prodObj, $productQuantity, $created_at, $updated_at]);
                        }

                    // return $productQuantity;
                    $productName =  $request->productName;
                    $productQuantity =  $request->quantity;
                    // inserindo quantidades
                    $max2 = sizeof($productName);
                    $max3 = sizeof($productQuantity);
                    $quoteReference = $id;
                    for($i=0; $i<$max2; $i++){
                        // return $productQuantity[$prodName];
                        DB::table('products_machines_quotes')
                            ->where('quoteReference', $quoteReference)
                            ->where('product_id',  $productName[$i])
                            ->update(['productQuantity' => $productQuantity[$i]]);

                        // $productsAndQuantities[] =  $productName[$i]. " and" . " quantity " . $productQuantity[$i];
                    }

                }
            }

            $from = "MachineViewPage";

            if($addQuantitiesSection == false)
            {
                return redirect()
                        ->route('machine.viewPage', ['id' => $MachineId])
                        ->with('success',  'The Quote was successful updated');
            }
            else{   
                    return redirect()
                    ->route('quote.edit', ['id' => $id, 'from' => $from, 'updatingWarning' => $updatingWarning]);
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


    public function quotesAlreadyDone($id = null, $from = null)
    {

        if($from == "MachineViewPage"){
            $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')->where('machine', 'LIKE', $id)->get();
            $getQuotesOwnerInfos = allquotesinformations::where('machine', 'LIKE', $id)->first();

            if($getQuotesOwnerInfos == null || $getQuotesOwnerInfos == "" || $getQuotesOwnerInfos == "[]"){
                    return redirect()
                    ->back()
                    ->with('error',  'You dont have previous quotes to see' );
            }
            else
            {
                $customerName = $getQuotesOwnerInfos->customerName;
                $customerId = $getQuotesOwnerInfos->customerId;
                return view('sections.quote.quotesAlreadyDone.index', compact('allQuotes', 'getQuotesOwnerInfos', 'customerName', 'customerId'));
            }
        }
        else{
            $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')->get();
            return view('sections.quote.quotesAlreadyDone.index', compact('allQuotes'));
        }
    }

    public function ViewquotesAlreadyDone($id)
    {

        $allQuotes = allquotesinformations::find($id);
        // name of the customer
        $name = $allQuotes->customer;

        // name of the machine
        $machine = $allQuotes->machine;

        $allcustomers = Customer::all();
        $allmachines = Machine::all();

        $ProductsInfo = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();


        return view('sections.quote.quotesAlreadyDone.view', compact('ProductsInfo', 'allQuotes', 'allcustomers', 'allmachines', 'name', 'machine'));

    }


    public function previewInvoice($id, $from = null)
    {

        $allqtInformations = allquotesinformations::find($id);
        // return $allqtInformations->id;

        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
        // $ProductsInfo = ShowProductsByMachines::whereRaw('workOrderReference = ' . $id)->get();
        // $ProductsInfo = overviewbetweenworkorderandproductsqts ::whereRaw('pmwWorkOrderReference = ' . $id)->get();
        $ProductsInfo = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();
        $ExtraItems = extraitems::where('quoteId', 'LIKE', $id)->get();

        // if ($ProductsInfo == "[]"){
        //         return redirect()
        //         ->back()
        //         ->with('warning',  'You cannot see this previous invoice because there is no Product on this Quote' );
        // }


        // $machineId = Machine::find($id);
        // $ownerId = $machineId->owner;
        // $machineswithowner = machineswithowner::where('idCustomer', 'LIKE', $owId}%")->first();
        // $nameOwner = $machineswithowner->nameCustomer;

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        
        return view('sections.quote.previewinvoice', compact('allqtInformations','allcustomers', 'allmachines','id', 'ProductsInfo', 'from', 'ExtraItems'));

    }


    public function gerarinvoice(Request $request){

        // id e workorderreference [e a mesma coisa no contexto ]
            $id =  $request->id;
            $quoteReference = $id;
            $newInvoiceId =  $request->newInvoiceId;
            $newInvoiceCreatedDate =  $request->newInvoiceCreatedDate;
            $thisQuoteId = $id;
            // retornando dados desse invoice

            $findinvoice = quotepreviewinvoice::find($newInvoiceId)->first();
            $invoicecreatedate = $findinvoice->created_at;

            // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
            $Machine_Id =  $request->machine;
            $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
            $machine_name = ($machine_info->model);
            $entry_machine_date = ($machine_info->created_at);

            // acha as peças na maquina where o id da work order for a mesma q a workorder atual
            $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();

            // infomações das work orders
             $allworkOrders = allquotesinformations::whereRaw('machineId= ' . $Machine_Id)->first();


            $typeofpayment =  $request->typeofpayment;
            $nameCustomer =  $request->customer;
            $dataConfirmPay = $request;
            $product = $dataConfirmPay->title;

            $customer_report = $request->customer_report;
            $last_observations = $request->last_observations;

            // achando os valores na products workorders de acordo com o id da workorder dessa pagina
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
            $ProductsInfo2 = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();


            // retornando os valores que vao para o card geral dessa ordem de serviço
            $showonoverviewworkorders = quotepreviewinvoice::whereRaw('quoteReference = ' . $quoteReference)->get();


            $quotepreviewinvoice= quotepreviewinvoice::where('quoteReference', 'LIKE', $id)->first();

            $amountProducts  = $request->amountProducts;
            return view('sections.quote.quoteinvoice', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment', 'machine_name' ,'ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'quotepreviewinvoice', 'amountProducts', 'thisQuoteId'));

    }



    public function checarInvoiceSemCadastrar(Request $request)
    {


        if($request->worklabor == 'NaN' || $request->worklabor == null || $request->worklabor == '' ||
            $request->discount == 'NaN' || $request->discount == null || $request->discount == ''
        ){
            return redirect()
            ->back()
            ->with('warning',  'You must add a valid value for the service and discount' );
        }

        $id =  $request->quoteReference;
        $last_observationsPreview = $request->last_observations;


        // id e quoteReference [e a mesma coisa no contexto ]
        $quoteReference = $id;
        $newInvoiceId =  0;
        $newInvoiceCreatedDate =  date('d/m/Y');
        $invoicecreatedate =  $newInvoiceCreatedDate;
        $thisQuoteId = $id;

        //pra achar o id da machine e outras infos do QUOTE
            $findQuote = Quote::find($id)->get()->first();
            $Machine_Id = $findQuote->machine;
            $nameCustomer =  $findQuote->customer;
            $product = $findQuote->title;
            $customer_report = $findQuote->customer_report;
            $last_observations = $findQuote->last_observations;
        //

        $quotesCreatedAt =  date('d/m/Y', strtotime($findQuote->created_at));
        $allquotes =  $quotesCreatedAt;

         $machine_info = ( DB::select('SELECT * from machines where  id =' . $request->machine )[0]);
         $machine_name = ($machine_info->model);
         $entry_machine_date = ($machine_info->created_at);
        $idOwner = ($machine_info->owner);
        // finding the owner's name




        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
        $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();

        $ProductsInfo2 = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();

        // infomações das quotes POREÉM NAO SAO QUOTES AINDA, SAO PREVIEWS APENAS
        // $allworkOrders = allquotesinformations::whereRaw('machineId= ' . $Machine_Id)->first();

        $allworkOrders = allquotesinformations::whereRaw('id= ' . $quoteReference)->first();


        if ($allworkOrders != ''){
            $machine_model = ($machine_info->model);
            $machine_brand = ($machine_info->brand);
            $entry_machine_date = ($machine_info->created_at);
        }

        // infos do request

        $idOwner =  $request->customerName;
        $findThisCustomer = Customer::where('id', 'LIKE', $idOwner)->first();
        //
        $customerName = $request->customerName;
        $machine_model = $machine_name;
        $machine_brand = ($machine_info->brand);
        $entry_machine_date = ($machine_info->created_at);
        $entry_machine_date =  date('d/m/Y', strtotime($entry_machine_date));

        // fim das infos




        // dados dos campos que colocamos manualmente (discount, work labour)
        // E DADOS GERAIS

        // vendo a soma dos produtos nessa work Order
        $findthisoverviewExtraItems = totalextraitems::where('quoteId', 'LIKE', $id)->first();
        $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $id)->first();
         if($findthisoverview == "" || $findthisoverview == null ){
                // return "sem produto";

                if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                {

                    // return "sem produto nem nada";

                    $typeofpayment = $request->typeofpayment;
                    $discount = $request->discount;
                    $worklabor = $request->worklabor;

                    $SubTotal = $worklabor;
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

                    $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                    $discount = number_format($discount, 2, '.',',');
                    $vat = number_format($vat, 2, '.',',');


                    return view('sections.quote.previewqts.quoteinvoice', compact('nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'thisQuoteId', 'invoicecreatedate', 'typeofpayment', 'discount', 'quoteReference', 'worklabor',  'machine_model', 'machine_brand', 'allquotes', 'last_observationsPreview','customerName', 'findThisCustomer', 'entry_machine_date', 'totalExtraItemsStatus', 'SubTotalFormated', 'totalWithVAT', 'onlyServiceMsg', 'vat'));


                }

                else{
                        // ONLY EXTRA ITEMS

                        $findthisoverviewExtraItems = totalextraitemsquoteId::where('quoteId', 'LIKE', $request->id)->first();
                        $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItems;

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


                        $SubTotalFormated = number_format($SubTotal, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($SubTotal, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');
                        $totalExtraItemsStatus = "setup";

                        $allextraitems = extraitems::where('quoteId', 'LIKE', $id)->get();
                        $ProductsStatus = "empty";

                        return view('sections.quote.previewqts.quoteinvoice', compact('nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'thisQuoteId', 'invoicecreatedate', 'typeofpayment', 'discount', 'quoteReference', 'worklabor', 'totalWithVAT', 'machine_model', 'machine_brand', 'allquotes', 'last_observationsPreview','customerName', 'findThisCustomer', 'entry_machine_date', 'SubTotalFormated', 'allextraitems', 'totalExtraItemsWithoutVAT','totalExtraItemsStatus', 'ProductsStatus', 'vat'));

                }

         }

         else{  // SE TEM PRODUTOS SELECIONADOS NA ORDEM


                $amountProducts = $findthisoverview->totalProductsonThisQuote;
                $amount = (($request->amount) + $amountProducts) ; // AMOUNT É O SUBTOTAL
                $amountwithoutproducts = (($request->amount)) ; // AMOUNT É O SUBTOTAL
                $machineId = $request->machine;
                $typeofpayment = $request->typeofpayment;
                $discount = $request->discount;
                $quoteReference = $request->id;
                $worklabor = $request->worklabor;

                $total =     (($amount - $discount) +$worklabor);
                $totalwithoutproducts = (($amountwithoutproducts - $discount) +$worklabor);
                //  $subtotal = (($amount - $discount) +$worklabor);

                // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso
                $totalWithVAT = ($totalwithoutproducts * 0.20) + $total;


                // extraitems
                    // o total dos extraitems somados
                    // $findthisoverviewExtraItems = totalextraitems::where('quoteId', 'LIKE', $id)->first();
                    if($findthisoverviewExtraItems == null){
                        // return "com produto sem extra";
                        // vat total *tirando os produtos que ja vieram com vat *

                        $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $id)->first();
                        $amountProducts = $findthisoverview->totalProductsonThisQuote;

                        $quoteReference = $request->id;
                        $typeofpayment = $request->typeofpayment;
                        $discount = $request->discount;
                        $worklabor = $request->worklabor;


                        $SubTotal = ($worklabor + $amountProducts); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                        $vat = ($SubTotal * 0.20);
                        $subTotalWithVAT = ($SubTotal  + $vat);
                        $total = $SubTotal - $discount; // total without vat
                        $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat
                        // $amoutwkwithoutprods = ((($worklabor + $totalExtraItemsWithoutVAT)  * 1.20) - $discount);



                        // total nogeral junto com a soma do vat geral tiaando produtos pois o produto ja veio com o vat incluso

                        $SubTotalFormated = $amount + $worklabor;
                        $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($amount, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $amountProducts = number_format($amountProducts, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');

                        // quando  nao tiver extraitems vamos setar o valor para 0;
                        $totalExtraItemsVAT = 0;
                        $totalExtraItemsStatus = "empty";

                        $allextraitems = extraitems::where('quoteId', 'LIKE', $id)->get ();
                        return view('sections.quote.previewqts.quoteinvoice', compact('nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'quoteReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'machine_model', 'machine_brand', 'allquotes', 'last_observationsPreview','customerName', 'findThisCustomer', 'entry_machine_date', 'SubTotalFormated', 'allextraitems', 'totalExtraItemsVAT','totalExtraItemsStatus'));
                        //endextraitems
                    }
                    else{


                        $findthisoverviewExtraItems = totalextraitemsquoteId::where('quoteId', 'LIKE', $request->id)->first();
                        $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItems;

                     // only products
                        // $findthisoverview = totalprodsSelectedWK::where('workOrderId', 'LIKE', $request->id)->first();
                        $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $id)->first();



                     //infos da pagina processing
                         $workOrderReference = $request->id;
                         $typeofpayment = $request->typeofpayment;
                         $discount = $request->discount;
                         $worklabor = $request->worklabor;


                         // Amount total dos produtos (PREÇOS SEM VAT)
                        //  return $amountProducts
                        //  return $a = [$worklabor , $amountProducts , $totalExtraItemsWithoutVAT];
                         $SubTotal = ($worklabor + $amountProducts + $totalExtraItemsWithoutVAT); // AMOUNT É O SUBTOTAL E O SUBTOTAL É O AMOUNT
                         $vat = ($SubTotal * 0.20);
                         $subTotalWithVAT = ($SubTotal  + $vat);
                         $total = $SubTotal - $discount; // total without vat
                         $totalWithVAT = $subTotalWithVAT - $discount;  // total with  vat


                         $SubTotalFormated = number_format($SubTotal, 2, '.',',');
                         $vat = number_format($vat, 2, '.',',');
                         $amount = number_format($amount, 2, '.',',');
                         $discount = number_format($discount, 2, '.',',');
                         $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                         $amountProducts = number_format($amountProducts, 2, '.',',');
                         $worklabor = number_format($worklabor, 2, '.',',');
                         $totalExtraItemsStatus = "setup";

                        $allextraitems = extraitems::where('quoteId', 'LIKE', $id)->get ();

                        return view('sections.quote.previewqts.quoteinvoice', compact('nameCustomer' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'quoteReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat', 'machine_model', 'machine_brand', 'allquotes', 'last_observationsPreview','customerName', 'findThisCustomer', 'entry_machine_date', 'SubTotalFormated', 'allextraitems', 'totalExtraItemsWithoutVAT','totalExtraItemsStatus'));
                        //endextraitems

                    }
         }

    }


    public function viewPreviewinvoice($id)
    {

            
            // id e workorderreference [e a mesma coisa no contexto ]
            // $newInvoice =  workorder_invoice::where('workOrderReference', 'LIKE', $id)->first();
            $findPreviewinvoice = quotepreviewinvoice::where('quoteReference', 'LIKE', $id)->first();
            $machineId = $findPreviewinvoice->machineId;
            $quoteReference = $findPreviewinvoice->quoteReference;
            $workOrderReference = $findPreviewinvoice->workOrderReference;
            $createInvoice = $findPreviewinvoice->save();


        // OQ ESTAVA AQUI ANTES
            $findthisoverview = totalprodsselectedquote::where('quoteIdInQuote', 'LIKE', $id)->first();
            if($findthisoverview == "[]" || $findthisoverview == null) {
                $amountProducts = "[]";
            }
            else{
                $amountProducts = $findthisoverview->totalProductsonThisQuote;
            }


            // id e workorderreference [e a mesma coisa no contexto ]
            $workOrderReference = $id;
            $newInvoiceId =  $findPreviewinvoice->id;
            // $newInvoiceCreatedDate =  $request->newInvoiceCreatedDate;

            // retornando dados desse invoice

            $findinvoice = quotepreviewinvoice::find($newInvoiceId)->first();
            $invoicecreatedate = $findinvoice->created_at;



            // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
            $Machine_Id =  $machineId;

             $findThisMachine = Machine::where('id', $Machine_Id)->get();

            if($findThisMachine == "[]"){
                return redirect()
                ->back()
                ->with('error',  'This machine is no longer registered in the system' );
            }

            $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);

            $machine_model = ($machine_info->model);
            $machine_brand = ($machine_info->brand);
            $entry_machine_date = ($machine_info->created_at);
            $entry_machine_date =  date('d/m/Y', strtotime($entry_machine_date));


            // acha as peças na maquina where o id da work order for a mesma q a workorder atual
            $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();

            // infomações das work orders
             $allworkOrders = allquotesinformations::whereRaw('machineId= ' . $Machine_Id)->first();


            // WorkOrder
            $quotesInfos = Quote::find($id)->first();
            $qtId =  $quotesInfos->id;
            $typeofpayment =  $quotesInfos->typeofpayment;
            $nameCustomer =  $quotesInfos->customer;
            $dataConfirmPay = $quotesInfos;
            $product = $dataConfirmPay->title;
            $customer_report = $quotesInfos->customer_report;
            $last_observations = $quotesInfos->last_observations;
            $newInvoiceCreatedDate =  $quotesInfos->created_at;

            $quotesCreatedAt =  date('d/m/Y', strtotime($quotesInfos->created_at));
            $quotesDateCreatedAt =  $quotesCreatedAt;


            // achando os valores na products workorders de acordo com o id da workorder dessa pagina
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
            $ProductsInfo2 = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();


            // // retornando os valores que vao para o card geral dessa ordem de serviço
            // $showonoverviewworkorders = showonoverviewworkorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();


            $quotepreviewinvoice= quotepreviewinvoice::where('QuoteReference', 'LIKE', $id)->first();

            // quote reference
            $quoteReference = $id;

            // return
            $worklabor = $quotepreviewinvoice->worklabor;
            $amount = $quotepreviewinvoice->amount;
            $vat = $quotepreviewinvoice->vat;
            $discount = $quotepreviewinvoice->discount;
            $totalWithVAT = $quotepreviewinvoice->totalWithVAT;


                // LOGICA INSERIDO PARA MAIS DIFERENTES EXIBIÇÕES
                $findthisoverviewExtraItems = totalextraitems::where('quoteId', 'LIKE', $id)->first();
                $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $id)->first();
                if($findthisoverview == "" || $findthisoverview == null ){

                        if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                        {

                            // somente a mao de obra
                            // return "somente mao de obra";

                            // quote reference
                            $quoteReference = $id;

                            // return
                            $worklabor = $quotepreviewinvoice->worklabor;
                            $amount = $quotepreviewinvoice->amount;
                            $discount = $quotepreviewinvoice->discount;
                            $totalWithVAT = $quotepreviewinvoice->totalWithVAT;
                            $SubTotalFormated =  $worklabor;
                            $onlyServiceMsg = "enabled";

                            $worklabor = number_format($worklabor, 2, '.',',');
                            $amount = number_format($amount, 2, '.',',');
                            $discount = number_format($discount, 2, '.',',');
                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            $vat = number_format($vat, 2, '.',',');
                            $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');


                            // so vamos deixar o products info  para puxar o vazio mesmo
                            $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();
                            $onlyServiceMsg = "enabled";
                            $totalExtraItemsStatus = "empty";

                            return view('sections.quote.finalInvoice.qtInvoice', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'quotepreviewinvoice', 'amountProducts', 'qtId', 'Machine_Id', 'machine_model', 'machine_brand', 'quotesDateCreatedAt', 'quoteReference', 'worklabor','amount', 'vat', 'discount', 'totalWithVAT', 'SubTotalFormated', 'entry_machine_date','totalExtraItemsStatus', 'onlyServiceMsg'));

                        }

                        else{
                                // return "only extra items";

                                // // se tiver algum produto com valor extra cadastrado
                                // $totalExtraItemsVAT = $findthisoverviewExtraItems->totalExtraItemsVAT;
                                // $totalWithVAT = $quotepreviewinvoice->totalWithVAT + $totalExtraItemsVAT;
                                // $quoteId = $findthisoverviewExtraItems->quoteId;
                                // $SubTotalFormated = $amount + $worklabor + $totalExtraItemsVAT; // SOMANDO COM O TOTAL DOS VALORES EXTRAS

                                // $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVat;

                                $worklabor = $quotepreviewinvoice->worklabor;
                                $vat = $quotepreviewinvoice->vat;
                                $amount = $quotepreviewinvoice->amount; // subtotal
                                $discount = $quotepreviewinvoice->discount;
                                $totalWithVAT = $quotepreviewinvoice->totalWithVAT;



                                $SubTotalFormated = number_format($amount, 2, '.',',');
                                // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');
                                $vat = number_format($vat, 2, '.',',');
                                $amount = number_format($amount, 2, '.',',');
                                $discount = number_format($discount, 2, '.',',');
                                $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                                // $amountProducts = number_format($amountProducts, 2, '.',',');
                                $worklabor = number_format($worklabor, 2, '.',',');


                                $allextraitems = extraitems::where('quoteId', 'LIKE', $id)->get ();
                                $totalExtraItemsStatus = "setup";

                                $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();


                                return view('sections.quote.finalInvoice.qtInvoice', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'quotepreviewinvoice', 'amountProducts', 'qtId', 'Machine_Id', 'machine_model', 'machine_brand', 'quotesDateCreatedAt', 'quoteReference', 'worklabor','amount', 'vat', 'discount', 'totalWithVAT', 'SubTotalFormated', 'entry_machine_date',  'allextraitems','totalExtraItemsStatus', 'ProductsInfo'));

                        }
                    }

        // FIM DA LOGICA



            // extraitems
                        // o total dos extraitems somados
                        $findthisoverviewExtraItems = totalextraitems::where('quoteId', 'LIKE', $id)->first();

                        if($findthisoverviewExtraItems == null){
                            // vat total *tirando os produtos que ja vieram com vat *
                            // return "products without extraitems";

                            $worklabor = $quotepreviewinvoice->worklabor;
                            $vat = $quotepreviewinvoice->vat;
                            $amount = $quotepreviewinvoice->amount; // subtotal
                            $discount = $quotepreviewinvoice->discount;
                            $totalWithVAT = $quotepreviewinvoice->totalWithVAT;


                            $SubTotalFormated = number_format($amount, 2, '.',',');
                            // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');
                            $vat = number_format($vat, 2, '.',',');
                            $amount = number_format($amount, 2, '.',',');
                            $discount = number_format($discount, 2, '.',',');
                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            // $amountProducts = number_format($amountProducts, 2, '.',',');
                            $worklabor = number_format($worklabor, 2, '.',',');

                            // quando  nao tiver extraitems vamos setar o valor para 0;
                            $totalExtraItemsVAT = 0;
                            $totalExtraItemsStatus = "empty";


                        }
                        else{

                            // return "products with extraitems";
                            // se tiver algum produto com valor extra cadastrado
                            $totalExtraItemsVAT = $findthisoverviewExtraItems->totalExtraItemsVAT;
                            $totalWithVAT = $quotepreviewinvoice->totalWithVAT + $totalExtraItemsVAT;
                            $quoteId = $findthisoverviewExtraItems->quoteId;

                            $worklabor = $quotepreviewinvoice->worklabor;
                            $vat = $quotepreviewinvoice->vat;
                            $amount = $quotepreviewinvoice->amount; // subtotal
                            $discount = $quotepreviewinvoice->discount;
                            $totalWithVAT = $quotepreviewinvoice->totalWithVAT;


                            $SubTotalFormated = number_format($amount, 2, '.',',');
                            // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');
                            $vat = number_format($vat, 2, '.',',');
                            $amount = number_format($amount, 2, '.',',');
                            $discount = number_format($discount, 2, '.',',');
                            $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                            // $amountProducts = number_format($amountProducts, 2, '.',',');
                            $worklabor = number_format($worklabor, 2, '.',',');


                            $amountProducts = number_format($amountProducts, 2, '.',',');
                            $worklabor = number_format($worklabor, 2, '.',',');
                            $totalExtraItemsStatus = "setup";
                }

                $allextraitems = extraitems::where('quoteId', 'LIKE', $id)->get ();
            //endextraitems



            return view('sections.quote.finalInvoice.qtInvoice', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2','product','customer_report',  'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'quotepreviewinvoice', 'amountProducts', 'qtId', 'Machine_Id', 'machine_model', 'machine_brand', 'quotesDateCreatedAt', 'quoteReference', 'worklabor','amount', 'vat', 'discount', 'totalWithVAT', 'SubTotalFormated', 'entry_machine_date',  'allextraitems', 'totalExtraItemsVAT','totalExtraItemsStatus'));
    }






    public function deleteinvoice($id, $quoteId)
    {
        // return $quoteId;
        $deletequote = quotepreviewinvoice::find($id)->delete();
        {$deleteextraitems = extraitems::where('quoteId', 'LIKE', $id)->delete();}


        //    {$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', $id)->delete();}

        if($deletequote){

            // voltando a quote para o status anterior
            $findquote = Quote::find($quoteId);
            $findquote->status = 0;
            $updateProd = $findquote->save();

            return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote preview was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error');

            }

    }


    public function updatePreviewQtAjax(Request $request)
    {
        $discountValue = $request->discountValue;
        $worklaborValue = $request->worklaborValue;
        $quoteReference = $request->quoteReference;

        $updateQuote = Quote::find($quoteReference);
        if(isset($updateQuote)){
            $updateQuote->discount = $discountValue;
            $updateQuote->wkservice = $worklaborValue;
            $updateThisWorkOrder = $updateQuote->save();
        }

        return $quoteReference;

    }

    public function searchQuoteAjax(Request $request)
    {   
         $searchInput = $request->searchInput;
         $orderByInput = $request->orderByInput;
         $ascOrDesc = $request->ascOrDesc;

        //choosing which one will be orderBy queries
        if($orderByInput == "orderById"){
            $orderByInputQuerry = "id";
        }

        else if($orderByInput == "orderByTitle"){
            $orderByInputQuerry = "title";
        }

        else if($orderByInput == "ordeByCustomer"){
            $orderByInputQuerry = "customerName";
        }

        else if($orderByInput == "orderByMachine"){
            $orderByInputQuerry = "machineModel";
        }
        
        else if($orderByInput == "orderByCustomerReport"){
            $orderByInputQuerry = "customer_report";
        }
        else if($orderByInput == "orderByStatus"){
            $orderByInputQuerry = "status";
        }
        else if($orderByInput == "orberByCreatedAt"){
            $orderByInputQuerry = "created_at";
        }
        
        if($orderByInput == "orderByAll"){
            $allproducts = allquotesinformations::where('title', 'LIKE', "%$searchInput%")
            ->orWhere('customer_report','LIKE', "%$searchInput%")             
            ->orWhere('id','LIKE', "%$searchInput%")             
            ->orWhere('status','LIKE', "%$searchInput%")             
            ->orWhere('machineModel','LIKE', "%$searchInput%")               
            ->orWhere('customerName','LIKE', "%$searchInput%")                
            ->orWhere('created_at','LIKE', "%$searchInput%")                
            ->get();
            return $allproducts;
        }
        else{
            $allproducts = allquotesinformations::where('title', 'LIKE', "%$searchInput%")
            ->orWhere('id','LIKE', "%$searchInput%")             
            ->orWhere('customer_report','LIKE', "%$searchInput%")             
            ->orWhere('status','LIKE', "%$searchInput%")             
            ->orWhere('machineModel','LIKE', "%$searchInput%")               
            ->orWhere('customerName','LIKE', "%$searchInput%")                
            ->orWhere('created_at','LIKE', "%$searchInput%")       
            ->OrderByRaw($orderByInputQuerry . ' '. $ascOrDesc)    
            ->get();
            return $allproducts;
        }
    }


    public function getQuoteAjaxByMachine(Request $request){

        $id = $request->machineId;
        $allQuotes = allquotesinformations::where('machine' , '=',  $id)->where('status', '!=', '1')->get(); // status 2 means status closed

        if($allQuotes == "[]" || $allQuotes == null || $allQuotes == [])
        {
            return 0;
        }
        else
        {
            return $allQuotes;
        }
        
    }


    public function getClosedQuoteByMachine(Request $request)
    {



        $id = $request->machineId;
        $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')->where('machine', 'LIKE', $id)->get();

      
        // // $allQuotes = allquotesinformations::where('machine' , '=',  $id)->where('status', '!=', '1')->get(); // status 2 means status closed
        // $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')->where('machine', 'LIKE', $id)->get();


        if($allQuotes == "[]" || $allQuotes == null || $allQuotes == [])
        {
            return 0;
        }
        else
        {
            return $allQuotes;
        }
        
    }


    
}
