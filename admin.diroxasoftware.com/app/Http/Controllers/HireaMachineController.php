<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Customer;
use App\internalmachines;
use App\machinesallinfos;
use App\Product;
use App\products_machines;
use App\productsmachinesallinfos;
use DB;
use App\hiringmachines;
use App\Machine;
use App\allhiringmachinesinfos;
use App\paymentshiringmachine;
use App\totalhiremachineincome;
use App\overviewpricesinfoshiremachines;
use App\totalcrosshireprice;
use App\totaldiscount;
use App\totalextracost;
use App\numberopenhirings;
use App\nclosedhiring;
use App\hiredmachinebycustomer;
use App\overviewhiremachinesinfos;
use App\WorkOrder;
use App\overviewhiringpayments;

class HireaMachineController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('sections.hireamachine.index');

    }

    public function allmachines($id = null)
    {       

        $machinesFounded = array();
        $hiringsFounded = array();
        $allmachines = internalmachines::all();
        $allhiringmachines = hiringmachines::all();
        // $allhiringm  achines == null ? $hiringsFounded =  'null' : $allhiringmachines = $allhiringmachines;



        if(isset($allmachines)){
            foreach($allmachines as $item){
                $machinesFounded[] =  $item->id;
            }
        }

        else{
            $machinesFounded[] = [];
        }

        if(isset($allhiringmachines)){
            foreach($allhiringmachines as $item){
                    $hiringsFounded[] =  $item->machineId;
            }
        }
        else{
                $hiringsFounded[] = [];
            }


        $array3 = array();


        foreach($machinesFounded as $machines){
            /* PUXANDO AS MAQUINAS QUE NAO ESTAO PRESENTES NA TABLE HIING. ENTAO AGORA ESSAS MAQUINAS ENCONTRADAS IRAO PRO FOREACH DA TABELA INTERNALMACHINES, 
                E A QUE TEM WK  SERÁ EXIBIDA ATRAVES DE OUTRO FOREACH DA TABELA WK*/
            if(!in_array($machines, $hiringsFounded)){
                $array3[] =  $machines;
            }
        }

        $maxArray3 = sizeof($array3);


        
        if($maxArray3 != 0)
        {
            for($i =0; $i < $maxArray3; $i++){
                // return $uniao[$i];
                $allinternalmachines = internalmachines::find($array3[$i]);
                $showFilteredMachines[] =  $allinternalmachines;
                $showFilteredMachinesStatus = true;

            }
        }

        else{
            $allmachineswithowner2 = internalmachines::all();
            $showFilteredMachinesStatus = false;
            $showFilteredMachines[] =  0;
        }


        
        if($id != null){
            $thisCustomer = Customer::find($id);
            //  $allhiremachinesinfos  = overviewhiremachinesinfos::groupBy('machineId')->get();
            $allhiremachinesinfos  = overviewhiremachinesinfos::groupBy('machineId')->groupBy('machineId')->get();
            // $allmachines = internalmachines::where('condition', 0)->get(); // means all the one are AVAILABLE FOR HIRINGÇ
            // $allmachines = internalmachines::all();

            return view('sections.hireamachine.allmachines', compact('allmachines', 'thisCustomer', 'showFilteredMachines', 'allhiringmachines', 'allhiremachinesinfos', 'showFilteredMachinesStatus'));
        }
        else{
            
            $allhiremachinesinfos  = overviewhiremachinesinfos::groupBy('machineId')->groupBy('machineId')->get();
            // $allmachines = internalmachines::where('condition', 0)->get(); // means all the one are AVAILABLE FOR HIRINGÇ
            // return $allhiremachinesinfos;

            return view('sections.hireamachine.allmachines', compact('allmachines', 'showFilteredMachines', 'allhiringmachines', 'allhiremachinesinfos', 'showFilteredMachinesStatus'));
        }
    }

    public function machinetohire($id)
    {
        
        $allmachines = internalmachines::where('id', $id)->where('condition', 0)->first();

        $allcustomers = Customer::all();
        $allproducts = Product::all();

        $nameOwnerMachine = $allmachines->customerName;
        $IdOwnerMachine = $allmachines->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $id)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $id)->get();


        // todos os produtos referenciados à essa maquina 
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

        $thisMachineCondition = $allmachines->condition;
        $from = "standard";

        return view('sections.hireamachine.selectedmachine', compact('allmachines', 'allcustomers', 'nameOwnerMachine', 'IdOwnerMachine', 'opcoesMarcadas', 'respostaProducts', 'statusNulo', 'allproducts', 'outrasop', 'from', 'thisMachineCondition')); 
        
    }


    public function findCustomer(Request $request)
    {
        $dataId = $request->data;
        $customerFind =  $prod = Customer::find($dataId);
        return $customerFind;
    }

    public function finalizingCustomerInfos(Request $request)
    {
        
        $owner = $request->owner;
        $id = $request->machineId;
        $allmachines = internalmachines::where('id', $id)->where('condition', 0)->first();

        $thisCustomer = Customer::find($owner);
        $allproducts = Product::all();

        $nameOwnerMachine = $allmachines->customerName;
        $IdOwnerMachine = $allmachines->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $id)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $id)->get();


        // todos os produtos referenciados à essa maquina 
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

        $thisMachineCondition = $allmachines->condition;
        $from = "standard";


        return view('sections.hireamachine.finalizingCustomerInfos', compact('allmachines', 'thisCustomer', 'nameOwnerMachine', 'IdOwnerMachine', 'opcoesMarcadas', 'respostaProducts', 'statusNulo', 'allproducts', 'outrasop', 'from', 'thisMachineCondition')); 
    }

    public function storehiring(Request $request)
    {
        $customerId =  $request->customerId;
        $proofOfAddress = $request->proofOfAddress;
        $idimage = $request->idimage;
        $Receivedimage = $request->image;
        $customer = Customer::find($customerId);


 
        // se receberam alguma imagem de perfil do usuario
        if($Receivedimage){
            $path =  $request->file('image')->store('images','public');
            $input['image'] = $path;
            $img = Image::make('storage/'. $path);
            $img->resize(2, 2);
        }
        if($idimage){ // se receberam o comprovante de id
                $pathIdimage =  $request->file('idimage')->store('images','public');
                $input['idimage'] = $pathIdimage;
                $img = Image::make('storage/'. $pathIdimage);
                $img->resize(2, 2);
        }
        if($proofOfAddress){ // se receberam o comprovante de residencia
            $pathProofAddress =  $request->file('proofOfAddress')->store('images','public');
            $input['proofOfAddress'] = $pathProofAddress;
            $img = Image::make('storage/'. $pathProofAddress);
            $img->resize(2, 2);
        }


            // $request->file('image') == null ?  $path = $customer->image : $path = $request->file('image')->store('images','public');
            // $request->file('proofOfAddress') == null ?  $pathProofAddress = $customer->proofOfAddress : $pathProofAddress = $request->file('proofOfAddress')->store('proofOfAddress','public');
            // $request->file('idimage') == null ?  $pathidImage = $customer->idimage : $pathidImage = $request->file('idimage')->store('idimage','public');


    
            $request->file('image') == null ?  $path = $customer->image : $path = $path;
            $request->file('proofOfAddress') == null ?  $pathProofAddress = $customer->proofOfAddress : $pathProofAddress = $pathProofAddress;
            $request->file('idimage') == null ?  $pathidImage = $customer->idimage : $pathidImage = $pathIdimage;

                

        // Updating Customer
        if(isset($customer)){
            $request->proofOfAddress == null ? $pathProofAddress =  "default.png" : $pathProofAddress = $pathProofAddress;
            $request->idimage == null ? $pathIdimage =  "default.png" : $pathIdimage = $pathIdimage;
            $customer->proofOfAddress =  $pathProofAddress;
            $customer->idimage =  $pathIdimage;
            $updatecustomers = $customer->save();
        }

        // recuperando dados para rodar na nova view

        $owner = $customer->id;
        $id = $request->machineId;
        $allmachines = internalmachines::where('id', $id)->where('condition', 0)->first();

        $thisCustomer = Customer::find($owner);
        $allproducts = Product::all();

        $nameOwnerMachine = $allmachines->customerName;
        $IdOwnerMachine = $allmachines->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $id)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $id)->get();


        // todos os produtos referenciados à essa maquina 
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

        $thisMachineCondition = $allmachines->condition;
        $from = "standard";

        
        if($updatecustomers)
        {
            return view('sections.hireamachine.thirdandlasthiringpage', compact('allmachines', 'thisCustomer', 'nameOwnerMachine', 'IdOwnerMachine', 'opcoesMarcadas', 'respostaProducts', 'statusNulo', 'allproducts', 'outrasop', 'from', 'thisMachineCondition')); 

        }

    }

    public function store(Request $request)
    { 


        $Receivedimage = $request->image;
        $idimage = $request->idimage;
        $proofOfAddress = $request->proofOfAddress;
        $newtelephones =  $request->newtelephones;
        // return $request;
        // return $idimage;

        // se receberam alguma imagem de perfil do usuario
        if($Receivedimage){
            $path =  $request->file('image')->store('images','public');
            $input['image'] = $path;
            $img = Image::make('storage/'. $path);
            $img->resize(2, 2);
        }
        if($idimage){ // se receberam o comprovante de id
                $pathIdimage =  $request->file('idimage')->store('images','public');
                $input['idimage'] = $pathIdimage;
                $img = Image::make('storage/'. $pathIdimage);
                $img->resize(2, 2);
        }
        if($proofOfAddress){ // se receberam o comprovante de residencia
            $pathProofAddress =  $request->file('proofOfAddress')->store('images','public');
            $input['proofOfAddress'] = $pathProofAddress;
            $img = Image::make('storage/'. $pathProofAddress);
            $img->resize(2, 2);
        }

        // return $a = [$path, $pathProofAddress];



        $request->telephone == null ? $telephone =  77777777777 : $telephone = $request->telephone;

        //verificando se as imagens foram gravadas corretamente
        $request->image == null ? $path =  "default.png" : $path = $path;
        $request->proofOfAddress == null ? $pathProofAddress =  "default.png" : $pathProofAddress = $pathProofAddress;
        $request->idimage == null ? $pathIdimage =  "default.png" : $pathIdimage = $pathIdimage;
        // return $a =[$path,$pathIdimage,$pathProofAddress];
        

        $request->telephone == null ? $telephone =  77777777777 : $telephone = $request->telephone;
        $request->email == null ? $email =  'email@mail.com' : $email = $request->email;
        $request->address == null ? $address =  'Customer Address' : $address = $request->address;
    
        $customercontact = $request->telephone;
        $createCustomer = new Customer();
        $createCustomer->image = $path;
        $createCustomer->name = $request->name;
        $createCustomer->telephone = $telephone;
        $createCustomer->email =  $email;
        $createCustomer->address =  $address;
        $createCustomer->proofOfAddress =  $pathProofAddress;
        $createCustomer->idimage =  $pathIdimage;
        $storeCustomers = $createCustomer->save();
        $thisCustomerId= $createCustomer->id;
        $created_at = $createCustomer->created_at;



        // inserindo newtelephones
        if($newtelephones != null || $newtelephones != ""){
            foreach ($newtelephones as $key => $prodObj){
                // $productQuantity = 1 ; // valor padrao
                $vals = $request->Productsoptions;
                $product_machine = DB::insert('insert into newtelephones (telephoneNumber, owner_id, created_at, updated_at) values (?, ?, ?, ?)', [$prodObj, $thisCustomerId, $created_at, $created_at]);
                }
        }

        if($storeCustomers){
             return redirect()->route('customer.createmachine', ['id' => $thisCustomerId]);
        }


        return redirect()->route('customer.create');
    }

    public function viacustomer($id, $customerId = null)
    {   

        $allproducts = Product::all();
        $allcustomers = Customer::all();
        $idThisCustomer =  $customerId;
        $thisCustomer = Customer::find($idThisCustomer);
        // $allmachines = Machine::all();
        $thisMachine = internalmachines::find($id);


        $nameOwnerMachine = $thisMachine->customerName;
        $IdOwnerMachine = $thisMachine->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $id)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $id)->get();

        // todos os produtos referenciados à essa maquina 
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

        $thisMachineCondition = $thisMachine->condition;

        return view('sections.hireamachine.viacustomer.choosingmachine', compact('thisCustomer','allcustomers', 'thisMachine', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop'));
    }


    public function openthehiring(Request $request)
    {
        // return $request->dataComecoPadraoDateTime;
        
        $discount =  $request->discount;
        $startHiringDate =  $request->inputStartHiring;
        $about =  $request->about;
        $finishHiringDate =  $request->inputfinishHiring;
        $totalDaysNumber =  $request->inputTotalDays;
        $hiringPrice = $request->hiringPriceField;
        $firstDepositPrice = $request->inputFirstDeposit;
        $machineId = $request->machineId;
        $customerId = $request->customerId;
        $priceperday = $request->machinePrice;
        $observation = "Here one observation";

        
        if($request->dataComecoPadraoDateTime == null || $request->dataFimPadraoDateTime == null || $request->inputStartHiring == null || $request->inputfinishHiring == null || $request->inputTotalDays < 0)
        {
            return redirect()
            ->back()
            ->with('error', 'You need to select the valid data range before start');
        }


        $request->about == null ? $about =  "no about" : $about = $request->about;




        if($startHiringDate == null || $finishHiringDate == null)
        {
            return redirect()
            ->back()
            ->with('Please, add a valid date range before start');
        }

        // $vatAmount = $hiringPrice * 0.20;
        // $hiringPrice = $hiringPrice * 1.20;
        // $vatAmount = number_format($vatAmount, 2, '.',',');
        $hiringPrice = number_format($hiringPrice, 2, '.',',');

        $createHiringMachine = new hiringmachines();
        $createHiringMachine->priceperday = $priceperday;
        $createHiringMachine->startHiringDate = $startHiringDate;
        $createHiringMachine->finishHiringDate = $finishHiringDate;
        $createHiringMachine->totalDaysNumber = $totalDaysNumber;
        $createHiringMachine->hiringPrice =  $hiringPrice;
        $createHiringMachine->vatAmount =  0.00; // como ainda nao é o valor final nao tem como puxarmos um vat
        $createHiringMachine->firstDepositPrice =  $firstDepositPrice;
        $createHiringMachine->machineId =  $machineId;
        $createHiringMachine->customerId =  $customerId;
        $createHiringMachine->discount =  $discount;
        $createHiringMachine->about =  $about;
        $createHiringMachine->hiringMachinesStatus =  0;
        $storeHiringMachine = $createHiringMachine->save();

        $updateMachine = internalmachines::find($machineId);
        $updateMachine->condition = 1;
        $creteIntmachine = $updateMachine->save();
        
        // return $a=[$startHiringDate, $finishHiringDate, $totalDaysNumber, $hiringPrice, $firstDepositPrice];
        if($storeHiringMachine)
        {   

            
            $findThisCustomer = Customer::where('id', 'LIKE', $customerId)->first();
            $findThisMMachine = internalmachines::find($machineId);
            $ProductsInfo  = productsmachinesallinfos::where('machine_id', 'LIKE', $machineId)->get();

            $about = $createHiringMachine->about;
            $firstDepositPrice = $createHiringMachine->firstDepositPrice;
            $startHiringDate = $createHiringMachine->startHiringDate;
            $finishHiringDate = $createHiringMachine->finishHiringDate;
            $vatAmount = $createHiringMachine->vatAmount;
            $totalDaysNumber = $createHiringMachine->totalDaysNumber;
            $priceperday = $createHiringMachine->priceperday;
            $discount = $createHiringMachine->discount;
            $hiringPrice = $createHiringMachine->hiringPrice;

            $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
            $priceperday = number_format($priceperday, 2, '.',',');
            $discount = number_format($discount, 2, '.',',');
            $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
            $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));
            
            $vatAmount = $hiringPrice * 0.20;
            $hiringPrice = $hiringPrice * 1.20;
            $payOnReturn = $hiringPrice - $firstDepositPrice;
            $vatAmount = number_format($vatAmount, 2, '.',',');
            $hiringPrice = number_format($hiringPrice, 2, '.',',');
            $payOnReturn = number_format($payOnReturn, 2, '.',',');

            return view('sections.hireamachine.invoicereceivedmachine', compact('findThisCustomer','observation', 'findThisMMachine', 'createHiringMachine', 'ProductsInfo', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'vatAmount'));
        }
    }


    public function destroy($id, $idOwner)
    {
        $findThisWk = hiringmachines::find($id)->first();
        $machineId = $findThisWk->machineId;
        $findThisWk = hiringmachines::find($id)->first()->delete();
        $findThisPaymentsHiring = paymentshiringmachine::where('hiringMachineId', $id)->delete();
        $routeURL = '/section/customers/viewPage/'. $idOwner;

        if($findThisWk){
            $updateMachine = internalmachines::find($machineId);
            $updateMachine->condition = 0;
            $creteIntmachine = $updateMachine->save();
        }

        if($findThisWk || $findThisPaymentsHiring){
            return redirect()
                    ->to($routeURL)
                    ->with('success',  'The Machine Hire was successful removed !' );
        }

        else
        {
            return redirect()
                        ->back()
                        ->with('error', $response['message']);

        }


    }

    public function viewpage($id, $customerId = null, $status = null, $from = null)
    {

        
        $allproducts = Product::all();
        $allcustomers = Customer::all();
        $idThisCustomer =  $customerId;
        $thisCustomer = Customer::find($idThisCustomer);

        $thisCustomer == "" ? $thiscustomercheck = "empty" : $email = $thiscustomercheck = "datas";

         

        // $allmachines = Machine::all();
        $thisHiringInfos = allhiringmachinesinfos::where('hiringMachineId', $id)->first();
        $idMachine = $thisHiringInfos->internalmachinesId;
        $thisMachine = internalmachines::find($idMachine);


        $nameOwnerMachine = $thisMachine->customerName;
        $IdOwnerMachine = $thisMachine->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $idMachine)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $idMachine)->get();

        // todos os produtos referenciados à essa maquina 
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

        // $createHiringMachine = new hiringmachines();


        $about = $thisHiringInfos->about;
        $firstDepositPrice = $thisHiringInfos->firstDepositPrice;
        $startHiringDate = $thisHiringInfos->startHiringDate;
        $finishHiringDate = $thisHiringInfos->finishHiringDate;
        $totalDaysNumber = $thisHiringInfos->totalDaysNumber;
        $priceperday = $thisHiringInfos->priceperday;
        $discount = $thisHiringInfos->discount;
        $hiringPrice = $thisHiringInfos->hiringPrice;
        $payOnReturn = $hiringPrice - $firstDepositPrice;


        $thisMachineCondition = $thisMachine->condition;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $id)->get();
        $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
        $machinePrice = number_format($thisMachine->price, 2, '.',',');
        $priceperday = number_format($priceperday, 2, '.',',');
        $discount = number_format($discount, 2, '.',',');
        $hiringPrice = number_format($hiringPrice, 2, '.',',');
        $payOnReturn = number_format($payOnReturn, 2, '.',',');
        $startHiringDateNoFormated = $startHiringDate;
        $finishHiringDateNoFormated = $finishHiringDate;

        $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
        $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));

        $routebacktoviewpage = $from;
        


        return view('sections.hireamachine.viacustomer.viewpage', compact('thisCustomer','allcustomers', 'thisMachine', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'machinePrice', 'thisHiringInfos', 'routebacktoviewpage', 'status', 'routebacktoviewpage', 'thiscustomercheck', 'startHiringDateNoFormated', 'finishHiringDateNoFormated'));

    }
   

    public function checkfirstinvoice($id)
    {

        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $id)->first();
        $createHiringMachine = $allhiremachines;
        $customerId = $allhiremachines->customerId;
        $machineId = $allhiremachines->machineId;
        
        // return $a=[$startHiringDate, $finishHiringDate, $totalDaysNumber, $hiringPrice, $firstDepositPrice];

            $findThisCustomer = Customer::where('id', 'LIKE', $customerId)->first();
            $findThisMMachine = internalmachines::find($machineId);
            $ProductsInfo  = productsmachinesallinfos::where('machine_id', 'LIKE', $machineId)->get();

            $about = $allhiremachines->about;
            $firstDepositPrice = $allhiremachines->firstDepositPrice;
            $startHiringDate = $allhiremachines->startHiringDate;
            $finishHiringDate = $allhiremachines->finishHiringDate;
            $totalDaysNumber = $allhiremachines->totalDaysNumber;
            $vatAmount = $allhiremachines->vatAmount;
            $priceperday = $allhiremachines->priceperday;
            $discount = $allhiremachines->discount;
            $hiringPrice = $allhiremachines->hiringPrice;

            $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
            $priceperday = number_format($priceperday, 2, '.',',');
            $discount = number_format($discount, 2, '.',',');

            $vatAmount = $hiringPrice * 0.20;
            $hiringPrice = $hiringPrice * 1.20;
            $payOnReturn = $hiringPrice - $firstDepositPrice;

            $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
            $hiringPrice = number_format($hiringPrice, 2, '.',',');
            $vatAmount = number_format($vatAmount, 2, '.',',');
            $payOnReturn = number_format($payOnReturn, 2, '.',',');

            $routebacktoviewpage = "yes";
            // return $allhiremachines->id;
            return view('sections.hireamachine.invoicereceivedmachine', compact('findThisCustomer', 'findThisMMachine', 'createHiringMachine', 'ProductsInfo', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'routebacktoviewpage', 'allhiremachines','vatAmount'));
    }

    public function checklastinvoice($id)
    {
        
        
        $hiringMachineId = $id;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $hiringMachineId)->first();
        $customerId = $allhiremachines->customerId;


        // return $request;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $hiringMachineId)->first();
        $firstDepositPrice = $allhiremachines->firstDepositPrice;
        $startHiringDate = $allhiremachines->startHiringDate;
        $finishHiringDate = $allhiremachines->finishHiringDate;
        $totalDaysNumber = $allhiremachines->totalDaysNumber;
        $priceperday = $allhiremachines->priceperday;
        $discount = $allhiremachines->discount;
        $hiringPrice = $allhiremachines->hiringPrice;
        $payOnReturn = $hiringPrice - $firstDepositPrice;
        $machineId = $allhiremachines->machineId;

        // cadastrando o pagamento realizado

        // $makeHiringPayment = new paymentshiringmachine();


        $findThisCustomer = Customer::where('id', 'LIKE', $customerId)->first();
        $findThisMMachine = internalmachines::find($machineId);
        $ProductsInfo  = productsmachinesallinfos::where('machine_id', 'LIKE', $machineId)->get();

        // return $hiringMachineId;
         $makeHiringPayment = paymentshiringmachine::where('hiringMachineId', $hiringMachineId)->get()->first();
        if($makeHiringPayment != []){

            $about = $makeHiringPayment->about;
            $firstDepositPrice = $makeHiringPayment->firstDepositPrice;
            $startHiringDate = $makeHiringPayment->startHiringDate;
            $finishHiringDate = $makeHiringPayment->finishHiringDate;
            $extraCost = $makeHiringPayment->extracost;
            $totalDaysNumber = $makeHiringPayment->totalDaysNumber;
            $priceperday = $makeHiringPayment->priceperday;
            $discount = $makeHiringPayment->discount;
            $hiringPrice = $makeHiringPayment->hiringPrice;
    
            $payOnReturn = $hiringPrice - $firstDepositPrice;
            $totalWithExtraCost = $hiringPrice + $extraCost;
            $payOnReturnWithExtraCost = $payOnReturn + $extraCost;
    
            $totalWithExtraCost = number_format($totalWithExtraCost, 2, '.',',');
            $payOnReturnWithExtraCost = number_format($payOnReturnWithExtraCost, 2, '.',',');
            $extraCost = number_format($extraCost, 2, '.',',');
            $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
            $priceperday = number_format($priceperday, 2, '.',',');
            $discount = number_format($discount, 2, '.',',');
            $hiringPrice = number_format($hiringPrice, 2, '.',',');
            $payOnReturn = number_format($payOnReturn, 2, '.',',');
            $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
            $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));
    
            $routebacktoviewpage = "yes";
    
            // return $allhiremachines->id;
            return view('sections.hireamachine.checklastinvoice', compact('findThisCustomer', 'findThisMMachine', 'ProductsInfo', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'routebacktoviewpage', 'allhiremachines', 'extraCost'));
        }

        else{
            return redirect()
            ->back()
            ->with('error', 'Something get wrong');
        }

    }


    public function finishHiringGetPayment(Request $request)
    {   
        
        $about = $request->about;
        $extraCost = $request->extraCost;
        $hiringMachineId = $request->hiringMachineId;
        $customerId = $request->customerId;
        $extraCost = $request->extraCost;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $hiringMachineId)->first();
        
        // return $request;
                        
        $firstDepositPrice = $allhiremachines->firstDepositPrice;
        $startHiringDate = $allhiremachines->startHiringDate;
        $finishHiringDate = $allhiremachines->finishHiringDate;
        $totalDaysNumber = $allhiremachines->totalDaysNumber;
        $priceperday = $allhiremachines->priceperday;
        $discount = $allhiremachines->discount;
        $hiringPrice = $allhiremachines->hiringPrice;
        $payOnReturn = $hiringPrice - $firstDepositPrice;
        $machineId = $allhiremachines->machineId;

        // att valor do vat e do preço final

        $hiringPrice = $hiringPrice + $request->extraCost;
        $vatAmount = $hiringPrice * 0.20;
        $hiringPrice = $hiringPrice * 1.20;
        

        // cadastrando o pagamento realizado
        $makeHiringPayment = new paymentshiringmachine();
        $makeHiringPayment->machineId = $machineId;
        $makeHiringPayment->customerId = $customerId;
        $makeHiringPayment->hiringMachineId = $hiringMachineId;
        $makeHiringPayment->priceperday = $priceperday;
        $makeHiringPayment->discount =  $discount;
        $makeHiringPayment->hiringPrice =  $hiringPrice;
        $makeHiringPayment->payOnReturn =  $payOnReturn;
        $makeHiringPayment->extracost =  $request->extraCost;
        $makeHiringPayment->about =  $about;
        $makeHiringPayment->totalDaysNumber =  $totalDaysNumber;
        $makeHiringPayment->startHiringDate =  $startHiringDate;
        $makeHiringPayment->finishHiringDate =  $finishHiringDate;
        $makeHiringPayment->firstDepositPrice =  $firstDepositPrice;
        $makeHiringPayment->vatAmount =  $vatAmount;
        $makeHiringPayment->paymentMethod =  "cash";
        $storeCustomers = $makeHiringPayment->save();



        // atualizando o status do hire para fechado
            $thisHireMachine = hiringmachines::where('id', $hiringMachineId)->first();
            $thisHireMachine->hiringMachinesStatus =  1;
            $thisHireMachine->hiringPrice =  $hiringPrice; // editando preço do hiring
            $thisHireMachine->vatAmount =  $vatAmount; // editando preço do VAT
            $updateHireMachineStts = $thisHireMachine->save();


        // atualizando o status do hire para fechado
            $thisInternalMachines = internalmachines::where('id', $machineId)->first();
            $thisInternalMachines->condition =  0;
            $updateInternalMachineStts = $thisInternalMachines->save();



        /// getting INFOS FOR THE INVOICE
            $createHiringMachine = $allhiremachines;
            $customerId = $allhiremachines->customerId;
            $machineId = $allhiremachines->machineId;
            
        // return $a=[$startHiringDate, $finishHiringDate, $totalDaysNumber, $hiringPrice, $firstDepositPrice];

            $findThisCustomer = Customer::where('id', 'LIKE', $customerId)->first();
            $findThisMMachine = internalmachines::find($machineId);
            $ProductsInfo  = productsmachinesallinfos::where('machine_id', 'LIKE', $machineId)->get();

            $about = $allhiremachines->about;
            $firstDepositPrice = $allhiremachines->firstDepositPrice;
            $startHiringDate = $allhiremachines->startHiringDate;
            $finishHiringDate = $allhiremachines->finishHiringDate;
            $totalDaysNumber = $allhiremachines->totalDaysNumber;
            $priceperday = $allhiremachines->priceperday;
            $discount = $allhiremachines->discount;
            $payOnReturn = $hiringPrice - $firstDepositPrice;
            // $totalWithExtraCost = $hiringPrice + $request->extraCost; 
            $totalWithExtraCost = $hiringPrice ; // ja esta com extracost
            $payOnReturnWithExtraCost = $payOnReturn + $request->extraCost;

            $totalWithExtraCost = number_format($totalWithExtraCost, 2, '.',',');
            $payOnReturnWithExtraCost = number_format($payOnReturnWithExtraCost, 2, '.',',');
            $extraCost = number_format($extraCost, 2, '.',',');
            $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
            $priceperday = number_format($priceperday, 2, '.',',');
            $discount = number_format($discount, 2, '.',',');
            $hiringPrice = number_format($hiringPrice, 2, '.',',');
            $payOnReturn = number_format($payOnReturn, 2, '.',',');
            $vatAmount = number_format($vatAmount, 2, '.',',');
            $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
            $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));

            $routebacktoviewpage = "yes";
            // return $allhiremachines->id;
            
            
        return view('sections.hireamachine.finalinvoice', compact('findThisCustomer', 'findThisMMachine', 'createHiringMachine', 'ProductsInfo', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'allhiremachines', 'totalWithExtraCost', 'payOnReturnWithExtraCost', 'extraCost', 'vatAmount'));
    }


    public function editingAndGettingPayment(Request $request)
    {



        // aqui 


         $hiringMachineId =  $request->hiringMachineId;
         $discount =  $request->discount;
         $startHiringDate =  $request->inputStartHiring;
         $about =  $request->about;
         $finishHiringDate =  $request->inputfinishHiring;
         $totalDaysNumber =  $request->inputTotalDays;
         $hiringPrice = $request->hiringPriceField;
         $firstDepositPrice = $request->inputFirstDeposit;
         $machineId = $request->machineId;
         $customerId = $request->customerId;
         $priceperday = $request->machinePrice;
         $observation = "Here one observation";
 
 
         
         $UpdateHiringMachine = hiringmachines::find($hiringMachineId);
 
         $request->about == null ? $about =  "no about" : $about = $request->about;
         $startHiringDate == "" ? $startHiringDate = $UpdateHiringMachine->startHiringDate : $startHiringDate = $request->inputStartHiring;
         $finishHiringDate == "" ? $finishHiringDate = $UpdateHiringMachine->finishHiringDate : $finishHiringDate = $request->inputfinishHiring;
         $totalDaysNumber == "" ? $totalDaysNumber = $UpdateHiringMachine->totalDaysNumber : $totalDaysNumber = $request->inputTotalDays;
         $hiringPrice == "" ? $hiringPrice = $UpdateHiringMachine->hiringPrice : $hiringPrice = $request->hiringPriceField;
         $firstDepositPrice == "" ? $firstDepositPrice = $UpdateHiringMachine->firstDepositPrice : $firstDepositPrice = $request->inputFirstDeposit;
 
 
 
         // if($request->dataComecoPadraoDateTime == null || $request->dataFimPadraoDateTime == null || $request->inputStartHiring == null || $request->inputfinishHiring == null || $request->inputTotalDays < 0)
         // {
         //     return redirect()
         //     ->back()
         //     ->with('error', 'You need to select the valid data range before start');
         // }
 
         if($request->inputStartHiring == null || $request->inputfinishHiring == null || $request->inputTotalDays <= 0)
         {
             return redirect()
             ->back()
             ->with('error', 'You need to select the valid data range before start');
         }
 
 
         $request->about == null ? $about =  "no about" : $about = $request->about;
 
 
         if($startHiringDate == null || $finishHiringDate == null)
         {
             return redirect()
             ->back()
             ->with('Please, add a valid date range before start');
         }
 
         // return $a = [$startHiringDate, $finishHiringDate];
 
         $UpdateHiringMachine->priceperday = $priceperday;
         $UpdateHiringMachine->startHiringDate = $startHiringDate;
         $UpdateHiringMachine->finishHiringDate = $finishHiringDate;
         $UpdateHiringMachine->totalDaysNumber = $totalDaysNumber;
         $UpdateHiringMachine->hiringPrice =  $hiringPrice;
         $UpdateHiringMachine->firstDepositPrice =  $firstDepositPrice;
         $UpdateHiringMachine->machineId =  $machineId;
         $UpdateHiringMachine->customerId =  $customerId;
         $UpdateHiringMachine->discount =  $discount;
         $UpdateHiringMachine->about =  $about;
         $UpdateHiringMachine->hiringMachinesStatus =  0;
         $storeHiringMachine = $UpdateHiringMachine->save();
 
         if($UpdateHiringMachine){
                // NOW THAT THE HIRING IS SUCCESSFULLY UPDATED WE FINISH THE HIRE AND GET THE PAYMENT
                  // return $request;
                    $about = $request->about;
                    $extraCost = $request->extraCost;
                    $hiringMachineId = $request->hiringMachineId;
                    $customerId = $request->customerId;
                    $extraCost = $request->extraCost;
                    $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $hiringMachineId)->first();
                    
                    // return $request;
                                    
                    $firstDepositPrice = $allhiremachines->firstDepositPrice;
                    $startHiringDate = $allhiremachines->startHiringDate;
                    $finishHiringDate = $allhiremachines->finishHiringDate;
                    $totalDaysNumber = $allhiremachines->totalDaysNumber;
                    $priceperday = $allhiremachines->priceperday;
                    $discount = $allhiremachines->discount;
                    $hiringPrice = $allhiremachines->hiringPrice;
                    $payOnReturn = $hiringPrice - $firstDepositPrice;
                    $machineId = $allhiremachines->machineId;

                    // cadastrando o pagamento realizado

                    $hiringPrice = $hiringPrice + $request->extraCost;
                    $vatAmount = $hiringPrice * 0.20;
                    $hiringPrice = $hiringPrice * 1.20;

                    $makeHiringPayment = new paymentshiringmachine();
                    $makeHiringPayment->machineId = $machineId;
                    $makeHiringPayment->customerId = $customerId;
                    $makeHiringPayment->hiringMachineId = $hiringMachineId;
                    $makeHiringPayment->priceperday = $priceperday;
                    $makeHiringPayment->discount =  $discount;
                    $makeHiringPayment->hiringPrice =  $hiringPrice + $request->extraCost;
                    $makeHiringPayment->payOnReturn =  $payOnReturn;
                    $makeHiringPayment->extracost =  $request->extraCost;
                    $makeHiringPayment->about =  $about;
                    $makeHiringPayment->totalDaysNumber =  $totalDaysNumber;
                    $makeHiringPayment->startHiringDate =  $startHiringDate;
                    $makeHiringPayment->finishHiringDate =  $finishHiringDate;
                    $makeHiringPayment->firstDepositPrice =  $firstDepositPrice;
                    $makeHiringPayment->vatAmount =  $vatAmount;
                    $makeHiringPayment->paymentMethod =  "cash";
                    $storeCustomers = $makeHiringPayment->save();

                    // atualizando o status do hire para fechado
                    $thisHireMachine = hiringmachines::where('id', $hiringMachineId)->first();
                    $thisHireMachine->hiringMachinesStatus =  1;
                    $thisHireMachine->about =  $about;
                    $thisHireMachine->hiringPrice =  $hiringPrice; // editando preço do hiring
                    $thisHireMachine->vatAmount =  $vatAmount; // editando preço do VAT
                    $updateHireMachineStts = $thisHireMachine->save();


                    // atualizando o status do hire para fechado
                    $thisInternalMachines = internalmachines::where('id', $machineId)->first();
                    $thisInternalMachines->condition =  0;
                    $updateInternalMachineStts = $thisInternalMachines->save();



                    /// getting INFOS FOR THE INVOICE
                        $createHiringMachine = $allhiremachines;
                        $customerId = $allhiremachines->customerId;
                        $machineId = $allhiremachines->machineId;
                        
                    // return $a=[$startHiringDate, $finishHiringDate, $totalDaysNumber, $hiringPrice, $firstDepositPrice];

                        $findThisCustomer = Customer::where('id', 'LIKE', $customerId)->first();
                        $findThisMMachine = internalmachines::find($machineId);
                        $ProductsInfo  = productsmachinesallinfos::where('machine_id', 'LIKE', $machineId)->get();

                        $about = $allhiremachines->about;
                        $firstDepositPrice = $allhiremachines->firstDepositPrice;
                        $startHiringDate = $allhiremachines->startHiringDate;
                        $finishHiringDate = $allhiremachines->finishHiringDate;
                        $totalDaysNumber = $allhiremachines->totalDaysNumber;
                        $priceperday = $allhiremachines->priceperday;
                        $discount = $allhiremachines->discount;
                        $vatAmount = $allhiremachines->vatAmount;
                        $payOnReturn = $hiringPrice - $firstDepositPrice;
                        // $totalWithExtraCost = $hiringPrice + $request->extraCost; 
                        $totalWithExtraCost = $hiringPrice ; // ja esta com extracost
                        $payOnReturnWithExtraCost = $payOnReturn + $request->extraCost;


                        $totalWithExtraCost = number_format($totalWithExtraCost, 2, '.',',');
                        $payOnReturnWithExtraCost = number_format($payOnReturnWithExtraCost, 2, '.',',');
                        $extraCost = number_format($extraCost, 2, '.',',');
                        $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
                        $priceperday = number_format($priceperday, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $hiringPrice = number_format($hiringPrice, 2, '.',',');
                        $payOnReturn = number_format($payOnReturn, 2, '.',',');
                        $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
                        $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));
                        $vatAmount = number_format($vatAmount, 2, '.',',');

                        $routebacktoviewpage = "yes";
                        // return $allhiremachines->id;

                        return view('sections.hireamachine.finalinvoice', compact('findThisCustomer', 'findThisMMachine', 'createHiringMachine', 'ProductsInfo', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'allhiremachines', 'totalWithExtraCost', 'payOnReturnWithExtraCost', 'extraCost','vatAmount'));

         }
    }



    public function reportsMachineHireviewPage($hiremachineid = null, $machineId = null, $status = null)
    {   
        // return $hiremachineid;
        // $overviewpricesinfoshiremachines = overviewpricesinfoshiremachines::where('hireMachineid', 'LIKE', 156)->first();
        $overviewpricesinfoshiremachines = overviewpricesinfoshiremachines::all();
        $allproducts = Product::all();
        $thisMachine = internalmachines::find($machineId);
        $thisMachine = internalmachines::find($machineId)->first();
        $thisHiringInfos = allhiringmachinesinfos::where('hiringMachineId', $hiremachineid)->first();
        $idThisCustomer = $thisHiringInfos->customerId;

        $thisCustomer = Customer::find($idThisCustomer);
        // $allmachines = Machine::all();
        $idMachine = $thisHiringInfos->internalmachinesId;
        $thisMachine = internalmachines::find($idMachine);

        $nameOwnerMachine = $thisMachine->customerName;
        $IdOwnerMachine = $thisMachine->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $idMachine)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $idMachine)->get();

        // todos os produtos referenciados à essa maquina 
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

        // $createHiringMachine = new hiringmachines();


        $thisHiringInfos = allhiringmachinesinfos::where('hiringMachineId', $hiremachineid)->first();
        $idMachine = $thisHiringInfos->internalmachinesId;
        $thisMachine = internalmachines::find($machineId);
        $about = $thisHiringInfos->about;
        $firstDepositPrice = $thisHiringInfos->firstDepositPrice;
        $startHiringDate = $thisHiringInfos->startHiringDate;
        $finishHiringDate = $thisHiringInfos->finishHiringDate;
        $totalDaysNumber = $thisHiringInfos->totalDaysNumber;
        $priceperday = $thisHiringInfos->priceperday;
        $discount = $thisHiringInfos->discount;
        $hiringPrice = $thisHiringInfos->hiringPrice;
        $payOnReturn = $hiringPrice - $firstDepositPrice;


        $thisMachineCondition = $thisMachine->condition;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $hiremachineid)->get();
        // $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
        $machinePrice = number_format($thisMachine->price, 2, '.',',');
        // $priceperday = number_format($priceperday, 2, '.',',');
        // $discount = number_format($discount, 2, '.',',');
        // $hiringPrice = number_format($hiringPrice, 2, '.',',');
        // $payOnReturn = number_format($payOnReturn, 2, '.',',');
        $startHiringDate = date('d/m/Y', strtotime($startHiringDate));
        $finishHiringDate = date('d/m/Y', strtotime($finishHiringDate));
        $routebacktoviewpage = "yes";

        if($machineId != null){
            $hiredmachinebycustomer  = hiredmachinebycustomer::where('machineId', $machineId)->get();
            $Nhiredmachinebycustomer  = hiredmachinebycustomer::where('machineId', $machineId)->count();
        }
        else{
            $hiredmachinebycustomer  = hiredmachinebycustomer::all();
        }

              $overviewpricesinfoshiremachines = overviewpricesinfoshiremachines::where('machineId', $machineId)->first();
              $NtimesHiredMachine = $overviewpricesinfoshiremachines->NhiringTimes;

        
        return view('sections.reports.machinesrepairs.mhviewpage', compact('thisMachine', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'machinePrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'hiringPrice', 'discount', 'firstDepositPrice', 'status', 'about', 'thisHiringInfos', 'thisCustomer', 'overviewpricesinfoshiremachines', 'hiredmachinebycustomer', 'Nhiredmachinebycustomer'));
    }


     
    public function edit($id, $customerId = null, $status = null, $from = null)
    {
        
        $allproducts = Product::all();
        $allcustomers = Customer::all();
        $idThisCustomer =  $customerId;
        $thisCustomer = Customer::find($idThisCustomer);

        $thisCustomer == "" ? $thiscustomercheck = "empty" : $email = $thiscustomercheck = "datas";

         

        // $allmachines = Machine::all();
        $thisHiringInfos = allhiringmachinesinfos::where('hiringMachineId', $id)->first();
        $idMachine = $thisHiringInfos->internalmachinesId;
        $thisMachine = internalmachines::find($idMachine);


        $nameOwnerMachine = $thisMachine->customerName;
        $IdOwnerMachine = $thisMachine->customerId;

        $opcoesMarcadas = array();
        $todosProdutos = array();
        
        $lista = DB::table('products')->get();
        $findProducts = products_machines::where('machine_id', 'LIKE', $idMachine)->get(); 
        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesallinfos::where('machine_id', 'LIKE', $idMachine)->get();

        // todos os produtos referenciados à essa maquina 
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

        // $createHiringMachine = new hiringmachines();


        $about = $thisHiringInfos->about;
        $hiringMachineId = $thisHiringInfos->hiringMachineId;
        $firstDepositPrice = $thisHiringInfos->firstDepositPrice;
        $startHiringDate = $thisHiringInfos->startHiringDate;
        $finishHiringDate = $thisHiringInfos->finishHiringDate;
        $totalDaysNumber = $thisHiringInfos->totalDaysNumber;
        $priceperday = $thisHiringInfos->priceperday;
        $discount = $thisHiringInfos->discount;
        $hiringPrice = $thisHiringInfos->hiringPrice;
        $payOnReturn = $hiringPrice - $firstDepositPrice;


        $thisMachineCondition = $thisMachine->condition;
        $allhiremachines = allhiringmachinesinfos::where('hiringMachineId', $id)->get();
        $firstDepositPrice = number_format($firstDepositPrice, 2, '.',',');
        $machinePrice = number_format($thisMachine->price, 2, '.',',');
        $priceperday = number_format($priceperday, 2, '.',',');
        $discount = number_format($discount, 2, '.',',');
        $hiringPrice = number_format($hiringPrice, 2, '.',',');
        $payOnReturn = number_format($payOnReturn, 2, '.',',');


        $routebacktoviewpage = $from;
        


        return view('sections.hireamachine.viacustomer.edit', compact('thisCustomer','allcustomers', 'thisMachine', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop', 'firstDepositPrice', 'priceperday', 'discount', 'hiringPrice', 'startHiringDate', 'finishHiringDate', 'totalDaysNumber', 'payOnReturn', 'about', 'machinePrice', 'thisHiringInfos', 'routebacktoviewpage', 'status', 'routebacktoviewpage', 'thiscustomercheck', 'hiringMachineId', 'from'));

    }




    public function update(Request $request)
    {   


        
        $from = $request->from;
        $hiringMachineId =  $request->hiringMachineId;
        $discount =  $request->discount;
        $startHiringDate =  $request->inputStartHiring;
        $about =  $request->about;
        $finishHiringDate =  $request->inputfinishHiring;
        $totalDaysNumber =  $request->inputTotalDays;
        $hiringPrice = $request->hiringPriceField;
        $firstDepositPrice = $request->inputFirstDeposit;
        $machineId = $request->machineId;
        $customerId = $request->customerId;
        $priceperday = $request->machinePrice;
        $observation = "Here one observation";


        
        $UpdateHiringMachine = hiringmachines::find($hiringMachineId);

        $request->about == null ? $about =  "no about" : $about = $request->about;
        $startHiringDate == "" ? $startHiringDate = $UpdateHiringMachine->startHiringDate : $startHiringDate = $request->inputStartHiring;
        $finishHiringDate == "" ? $finishHiringDate = $UpdateHiringMachine->finishHiringDate : $finishHiringDate = $request->inputfinishHiring;
        $totalDaysNumber == "" ? $totalDaysNumber = $UpdateHiringMachine->totalDaysNumber : $totalDaysNumber = $request->inputTotalDays;
        $hiringPrice == "" ? $hiringPrice = $UpdateHiringMachine->hiringPrice : $hiringPrice = $request->hiringPriceField;
        $firstDepositPrice == "" ? $firstDepositPrice = $UpdateHiringMachine->firstDepositPrice : $firstDepositPrice = $request->inputFirstDeposit;



        // if($request->dataComecoPadraoDateTime == null || $request->dataFimPadraoDateTime == null || $request->inputStartHiring == null || $request->inputfinishHiring == null || $request->inputTotalDays < 0)
        // {
        //     return redirect()
        //     ->back()
        //     ->with('error', 'You need to select the valid data range before start');
        // }

        if($request->inputStartHiring == null || $request->inputfinishHiring == null || $request->inputTotalDays <= 0)
        {
            return redirect()
            ->back()
            ->with('error', 'You need to select the valid data range before start');
        }


        $request->about == null ? $about =  "no about" : $about = $request->about;


        if($startHiringDate == null || $finishHiringDate == null)
        {
            return redirect()
            ->back()
            ->with('Please, add a valid date range before start');
        }

        // return $a = [$startHiringDate, $finishHiringDate];

        $vatAmount = 0;
        
        $UpdateHiringMachine->priceperday = $priceperday;
        $UpdateHiringMachine->startHiringDate = $startHiringDate;
        $UpdateHiringMachine->finishHiringDate = $finishHiringDate;
        $UpdateHiringMachine->totalDaysNumber = $totalDaysNumber;
        $UpdateHiringMachine->hiringPrice =  $hiringPrice;
        $UpdateHiringMachine->vatAmount =  $vatAmount;
        $UpdateHiringMachine->firstDepositPrice =  $firstDepositPrice;
        $UpdateHiringMachine->machineId =  $machineId;
        $UpdateHiringMachine->customerId =  $customerId;
        $UpdateHiringMachine->discount =  $discount;
        $UpdateHiringMachine->about =  $about;
        $UpdateHiringMachine->hiringMachinesStatus =  0;
        $storeHiringMachine = $UpdateHiringMachine->save();

        if($UpdateHiringMachine){
             if($from == "allmachineshiringpage"){
                    $route = "/section/internalMachines/view/".$machineId."/indexInternalMachines";
                    return redirect()
                    ->to($route)
                    ->with('success', 'Machine Hire Updated Successfully!');
             }
             else{
                    $route = "/section/customers/viewPage/".$customerId;
                    return redirect()
                    ->to($route)
                    ->with('success', 'Machine Hire Updated Successfully!');
             }
                
        }
    }

    public function markascollected(Request $request)
    {
               $workOrderId = $request->id;
               $machineId = $request->machineId;
               $UpdateWorkOrderId = WorkOrder::find($workOrderId);
               $UpdateWorkOrderId->status =  1;
               $storeHiringMachine = $UpdateWorkOrderId->save();

               return $machineId;
    }
}



// CREATE VIEW overviewpricesinfoshiremachines as 
// SELECT ph.id, ph.machineId, ph.customerId, ph.hiringMachineId, ph.priceperday, ph.discount, ph.hiringPrice, ph.payOnReturn, ph.extracost, ph.about,
//         ph.totalDaysNumber, SUM(ph.hiringPrice + 0) as totalHireMachineIncome, 
//         ph.startHiringDate, ph.finishHiringDate, ph.firstDepositPrice, ph.paymentMethod, COUNT(*) as NhiringTimes, 
//         i.id as internalmachineId, i.serial_number as internalmachineSnumber, i.brand as internalmachineBrand, i.model as internalmachineModel, 
//         i.condition as internalMachineCondition, i.price as internalmachinePrice, 
//         SUM(i.crossHireMachinePrice + 0)  as totalCrossHiringMachinePrice,
//         SUM(ph.discount + 0)  as totaldiscount,
//         i.crossHireMachinePrice, i.typemachine, i.created_at as internalMachineDateCreatedAt
//         from paymentshiringmachine ph
//         inner join internalmachines i 
//         where i.id = machineId 
//         GROUP BY machineId