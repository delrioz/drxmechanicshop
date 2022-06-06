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
use App\quotepreviewinvoice;
use App\workorder_invoice;
use App\totalprodsSelectedQuote;

class QuoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // status 0 means active

        $allQuotes = allquotesinformations::where('status' , 'LIKE', '0')
        ->get();


        return view('sections.quote.index', compact('allQuotes'));
    }

    public function create()
    {
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        return view('sections.quote.create', compact('allcustomers', 'allmachines', 'allproducts'));

    }

    public function store(QuoteFormRequest $request)
    {

        $request->title == null ? $title =  'No title' : $title = $request->title;
        $request->last_observations == null ? $last_observations =  'No last_observations' : $last_observations = $request->last_observations;

        // return $request;
        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);
        $customer_report = $allmachines->customer_report;


        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $createQuote = new Quote();
        $createQuote->title = $title;
        $createQuote->customer_report = $allmachines->customer_report;
        $createQuote->first_observations = $allmachines->first_observations;
        $createQuote->last_observations = $last_observations;
        $createQuote->customer = $allmachines->owner;
        $createQuote->machine = $request->input('machine');
        $createQuote->status = $request->input('status');
        $updateProd = $createQuote->save();



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
    }

    else{
        return redirect()
        ->back()
        ->with('error', $response['message']);

    }
        // quando tudo for feito vai retornar para uma tela de exibição para o mesmo escolher as quantitdades dos produtos


        // se algum produto foi selecionado
        if($request->Productsoptions){
            $thisQuoteId = $createQuote->quoteReference ;
            return redirect()->route('quote.chooseQuantity', ['id' => $thisQuoteId]);
        }
        else{
            return redirect()
            ->route('quote.index')
            ->with('success',  'The Quote was successful created !' );
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
        $findProducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->get(); 

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
         $ProductsInfo  = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->get(); 
         
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
    

    public function edit($id)
    {


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
        $findProducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->get(); 

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





    //     // retornar todos os produtos relacionados à essa ordem


    //        // products in this actual quote
    //        $ProductsInfo  = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->get(); 
         
    //        if ($ProductsInfo != '[]'){
    //        // add a um array todos os ids de produtos encontrados nessa ordem de serviço
    //        foreach($ProductsInfo as $item){
    //            $ProductsInfoIds[] =  $item->product_id;
    //        }
   
    //        // com esse array de ids vou fazer um foreach para buscar cada um desses itens na tabela produtos e me retornar tudo sobre ele naquela posição
    //        $max4 = sizeof($ProductsInfoIds);
    //        if($max4 != 0)
    //        {
    //            for($i =0; $i < $max4; $i++){
    //                // return $uniao[$i];
    //                 // $allproducsbyworkorders = Product::find($ProductsInfoIds[$i]);
    //                $allproducsbyworkorders = products_on_quotes::where('productId', 'LIKE', "%{$ProductsInfoIds[$i]}%")->get(); 
    //                $productsonthisWorkOrder =  $allproducsbyworkorders;
    //                $statusNulo2 = true;
    //            }
    //        }
    //    }
   
    //    else{
    //            $productsonthisWorkOrder =0;
    //            $statusNulo2 = false;
    //        }

            $statusNulo2 = false;
    
        // escolhendo a quantidade dos produtos selecionados nessa ordem de serviço
            $quoteReferenceId = $id;
            $ProductsSelected = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReferenceId)->get();

        return view('sections.quote.edit', compact('allQuotes', 'allcustomers', 'allmachines','name', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'statusNulo2', 'ProductsSelected'));
}


    public function destroy($id)
    {
        $deletequote = Quote::find($id)->delete();
       {$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();}
       
        if($deletequote){
            return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }



    public function confirmQuantity(Request $request){
    
        
            $productName =  $request->productName;
            $productQuantity =  $request->quantity;
            $quoteId =  $request->id;

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
        ->route('quote.index')
        ->with('success',  'The Quote was successful created!' );

 }

 
    public function update(QuoteFormRequest $request, $id)
    {   

        
        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

            $quote = Quote::find($id);
            if(isset($quote)){
            $quote->title = $request->input('title');
            $quote->customer_report = $request->input('customer_report');
            $quote->first_observations = $request->input('first_observations');
            $quote->last_observations = $request->input('last_observations');
            $quote->customer = $request->input('customer');
            $quote->machine = $request->input('machine');
            $quote->status = 0;
            $updatequote = $quote->save();

            if($updatequote){

                $quoteReference = $id;
                 $Productsoptions =  $request->Productsoptions;
                $MachineId = $quote->machine;
                $created_at = $quote->created_at;
                $updated_at = $quote->updated_at;
    
                 $findDatasonRelationTable = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->first();


                 
    
                if(!isset($Productsoptions)){
                    //se nenhum producto for selecionada, seja removida ou nao 
                    if($findDatasonRelationTable){$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();}
                    
                    return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote was successful updated!' );
                }
                
    
                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // create
                    foreach ($Productsoptions as $key => $prodObj){ 
                    $productQuantity = 1 ; // valor padrao
                    $vals = $request->Productsoptions;
                    $product_machine = DB::insert('insert into products_machines_quotes (quoteReference, machine_id, product_id, productQuantity, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$quoteReference, $MachineId, $prodObj, $productQuantity, $created_at, $updated_at]);
                    }
                }
    
                else{
                    //update  ->delete and create 
                    $productQuantity = 1 ; // valor padrao
                    $deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();
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

            return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote was successful updated' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }


    public function quotesAlreadyDone()
    {

        $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')->get();


        return view('sections.quote.quotesAlreadyDone.index', compact('allQuotes'));
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


    public function previewInvoice($id)
    {

        
        
         $allworkOrders = allquotesinformations::find($id);
        
        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
        // $ProductsInfo = ShowProductsByMachines::whereRaw('workOrderReference = ' . $id)->get();
        // $ProductsInfo = overviewbetweenworkorderandproductsqts ::whereRaw('pmwWorkOrderReference = ' . $id)->get();
         $ProductsInfo = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();

        if ($ProductsInfo == "[]" ){
                return redirect()
                ->route('quote.index')
                ->with('warning',  'You cannot see this previous invoice because there is no Product on this Quote' );
        }


        // $machineId = Machine::find($id);
        // $ownerId = $machineId->owner;
        // $machineswithowner = machineswithowner::where('idCustomer', 'LIKE', "%{$ownerId}%")->first();
        // $nameOwner = $machineswithowner->nameCustomer;

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        return view('sections.quote.previewinvoice', compact('allworkOrders','allcustomers', 'allmachines','id', 'ProductsInfo'));

    }


    public function gerarinvoice(Request $request){
        
            return "1";


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
            $first_observations = $request->first_observations;
            $last_observations = $request->last_observations;

            // achando os valores na products workorders de acordo com o id da workorder dessa pagina 
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();
            $ProductsInfo2 = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();


            // retornando os valores que vao para o card geral dessa ordem de serviço
            $showonoverviewworkorders = quotepreviewinvoice::whereRaw('quoteReference = ' . $quoteReference)->get();
            

            $quotepreviewinvoice= quotepreviewinvoice::where('quoteReference', 'LIKE', $id)->first();

            $amountProducts  = $request->amountProducts;
            return view('sections.quote.quoteinvoice', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment', 'machine_name' ,'ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'quotepreviewinvoice', 'amountProducts', 'thisQuoteId'));

    }



    public function checarInvoiceSemCadastrar(Request $request){


        return $request;
        
        $id =  $request->quoteReference;


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
            $first_observations = $findQuote->first_observations;
            $last_observations = $findQuote->last_observations;

        //

        $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
        $machine_name = ($machine_info->model);
        $entry_machine_date = ($machine_info->created_at);


        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
        $ProductsInfo = overviewquotesandproducts::whereRaw('pmqQuoteReference = ' . $quoteReference)->get();

        $ProductsInfo2 = overviewquotesandproducts::where('pmqQuoteReference', 'LIKE', $id)->get();

        // infomações das work orders
        $allworkOrders = allquotesinformations::whereRaw('machineId= ' . $Machine_Id)->first();
         



        // dados dos campos que colocamos manualmente (discount, work labour)
        // E DADOS GERAIS
        
        // vendo a soma dos produtos nessa work Order
        $findthisoverview = totalprodsSelectedQuote::where('quoteIdInQuote', 'LIKE', $id)->first();
        $amountProducts = $findthisoverview->totalProductsonThisQuote;



        $amount = (($request->amount) + $amountProducts) ; // AMOUNT É O SUBTOTAL
        $amountwithoutproducts = (($request->amount)) ; // AMOUNT É O SUBTOTAL
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


        //

        



        return view('sections.quote.previewqts.quoteinvoice', compact('nameCustomer', 'machine_name' ,'ProductsInfo', 'allworkOrders','product','customer_report', 'first_observations', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate',  'amountProducts', 'thisQuoteId', 'invoicecreatedate','amount','amountwithoutproducts', 'typeofpayment', 'discount', 'quoteReference', 'worklabor', 'total', 'totalwithoutproducts', 'totalWithVAT', 'vat'));

    }






    public function deleteinvoice($id, $quoteId)
    {
        // return $quoteId;
        $deletequote = quotepreviewinvoice::find($id)->delete();


        //    {$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();}
       
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
}
