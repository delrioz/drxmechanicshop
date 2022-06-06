<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Machine;
use App\machinesallinfos;
use App\WorkOrder;
use App\Quote;
use Image;
use App\Http\Requests\Internal\CustomerFormRequest;
use App\Http\Requests\Customer\MachineFormRequest;
use App\Http\Requests\Customer\CustomerEditFormRequest;
use App\infowswkinvoice;
use App\allcustomers;
use App\allworkorderinformations;
use DB;
use App\newtelephones;
use App\allwkpaymentsinfos;
use App\hiringmachines;
use App\allhiringmachinesinfos;
use App\allasales;


class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

         $allcustomers = allcustomers::get();

        return view('sections.customers.index', compact('allcustomers'));

    }

    public function create($from = null)
    {
        if($from == 'welcomePage'){
            $backRoute = 'welcomePage';
            return view('sections.customers.create', compact('from', 'backRoute'));
        }
        else{
            $backRoute = 'customerIndex';
            return view('sections.customers.create', compact('from', 'backRoute'));
        }
    }



    public function createMachineAjax(MachineFormRequest $request)
    {

        // $newMachine = Machine::create($request->all());
        $request->serial_number == null ? $serial_number =  "standard" : $serial_number = $request->serial_number;
        $request->model == null ? $model =  "standard" : $model = $request->model;
        $request->brand == null ? $brand =  "standard" : $brand = $request->brand;
        $request->mileage == null ? $mileage =  '0' : $mileage = $request->mileage;
        $request->observations == null ? $observations =  "No observations" : $observations = $request->observations;
        $owner = $request->owner;

        $createCustomerMachine = new Machine();
        $createCustomerMachine->serial_number = $serial_number;
        $createCustomerMachine->model = $model;
        $createCustomerMachine->owner = $owner;
        $createCustomerMachine->brand = $brand;
        $createCustomerMachine->mileage = $mileage;
        $createCustomerMachine->observations = $observations;
        $createMachine = $createCustomerMachine->save();


            // $createMachine = Machine::create($request->all());
            if($createMachine){return "criooou";}
            else{return "num deu";}

    }


    public function searchCustomerAjax(Request $request)
    {
         $searchInput = $request->searchInput;
         $orderByInput = $request->orderByInput;
         $ascOrDesc = $request->ascOrDesc;

        //choosing which one will be orderBy queries
        if($orderByInput == "orderById"){
            $orderByInputQuerry = "id";
        }

        else if($orderByInput == "orderByName"){
            $orderByInputQuerry = "name";
        }

        else if($orderByInput == "orberByCreatedAt"){
            $orderByInputQuerry = "created_at";
        }

        if($orderByInput == "orderByAll"){
            $allcustomers = Customer::where('name', 'LIKE', "%$searchInput%")
            ->orWhere('id','LIKE', "%$searchInput%")
            ->orWhere('email','LIKE', "%$searchInput%")
            ->orWhere('telephone','LIKE', "%$searchInput%")
            ->get();
            return $allcustomers;
        }
        else{
            $allcustomers = Customer::where('name', 'LIKE', "%$searchInput%")
            ->orWhere('id','LIKE', "%$searchInput%")
            ->orWhere('email','LIKE', "%$searchInput%")
            ->orWhere('telephone','LIKE', "%$searchInput%")
            ->OrderByRaw($orderByInputQuerry . ' '. $ascOrDesc)
            ->get();
            return $allcustomers;
        }
    }

    public function storeandnewmachine(CustomerFormRequest $request)
    {

        
        $Receivedimage = $request->image;
        $newtelephones =  $request->newtelephones;
        $proofOfAddress = $request->proofOfAddress;
        $idimage = $request->idimage;



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

        $request->image == null ? $path =  "default.png" : $path = $path;
        $request->proofOfAddress == null ? $pathProofAddress =  "default.png" : $pathProofAddress = $pathProofAddress;
        $request->idimage == null ? $pathIdimage =  "default.png" : $pathIdimage = $pathIdimage;


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


    // public function store(CustomerWithoutImageFormRequest $request)
    // {
                    // quando o create era com ajax
    //     // if($Receivedimage){
    //     //     $path =  $request->file('image')->store('images','public');
    //     //     $input['image'] = $path;
    //     //     $img = Image::make('storage/'. $path);
    //     //     $img->resize(2, 2);
    //     // }

    //     // else{
    //     //     $path = "default.png";
    //     // }

    //     $createCustomer = new Customer();
    //     $createCustomer->image = 'default.png';
    //     $createCustomer->name = $request->name;
    //     $createCustomer->telephone =  $request->telephone;
    //     $createCustomer->email =  $request->email;
    //     $createCustomer->address =  $request->address;
    //     $storeCustomers = $createCustomer->save();
    //     $thisCustomerId= $createCustomer->id;


    //     return "aqui";
    // }


    public function createandhiremachine(Request $request){
        return $request;
    }

    public function createmachine (Request $request){

        $latestMachine = machinesallinfos::latest()->first();
        $allcustomers = Customer::all();
        $idThisCustomer =  $request["id"];
        $thisCustomer = Customer::find($idThisCustomer);
        $allmachines = Machine::all();

        return view('sections.customers.subpathmachine.createmachine', compact('thisCustomer','allcustomers', 'allmachines', 'latestMachine'));
    }



    public function createmachineonviewpage ($id){
        // create machine on viewpage
        $allcustomers = Customer::all();
        $idThisCustomer =  $id;
        $thisCustomer = Customer::find($idThisCustomer);
        $allmachines = Machine::all();
        $latestMachine = machinesallinfos::latest()->first();

        return view('sections.customers.subpathmachine.createmachine', compact('thisCustomer','allcustomers', 'allmachines', 'latestMachine'));
    }





    public function createmachinestore(Request $request){
        Machine::create($request->all());
        return redirect()->route('machine.index');
    }



    public function createAjaxandAddmachine (Request $request)
    {
        Customer::create($request->all());
        return redirect()->route('customer.create');
    }



    public function edit($id, $from = null, $idMachineFrom = null)
    {
         $findNewNumbers = newtelephones::where('owner_id', 'LIKE', $id)->get();


        if($from == null){
            $allcustomers = Customer::find($id);
            $backRoute = 'customerIndex';
            return view('sections.customers.edit', compact('allcustomers', 'backRoute', 'findNewNumbers'));
        }
        else if($from == 'viewPage'){
            $allcustomers = Customer::find($id);
            $backRoute = 'customerViewPage';
            return view('sections.customers.edit', compact('allcustomers','backRoute', 'findNewNumbers'));
        }
        else if($from == 'choosingmachine'){
            // which machine this customer cames from $idMachineFrom
            $allcustomers = Customer::find($id);
            $backRoute = 'choosingmachine';
            return view('sections.customers.edit', compact('allcustomers','backRoute', 'findNewNumbers', 'idMachineFrom'));
        }
        else if($from == 'hiresmachinesviewpage'){
            // which machine this customer cames from $idMachineFrom
            $allcustomers = Customer::find($id);
            $backRoute = 'hiresmachinesviewpage';
            return view('sections.customers.edit', compact('allcustomers','backRoute', 'findNewNumbers'));
        }

    }



    public function viewPage($id)
    {

        $thisCustomer = Customer::find($id);

        // find machines and workorders
        $machinesFounded = array();
        $workOrderFounded = array();

        $allmachineswithowner = machinesallinfos::where('owner', 'LIKE', $id)->get();
        $allworkOrders = allworkorderinformations::where('customer', 'LIKE', $id)->get();

        foreach($allmachineswithowner as $item){
                $machinesFounded[] =  $item->id;
        }


        foreach($allworkOrders as $item){
                $workOrderFounded[] =  $item->machine;
        }



        $array3 = array();

        foreach($machinesFounded as $machines){
            /* PUXANDO AS MAQUINAS QUE NAO ESTAO PRESENTES NA WK. ENTAO AGORA ESSAS MAQUINAS ENCONTRADAS IRAO PRO FOREACH DA TABELA MACHINES,
                E A QUE TEM WK  SERÁ EXIBIDA ATRAVES DE OUTRO FOREACH DA TABELA WK*/

            if(!in_array($machines, $workOrderFounded)){
                $array3[] =  $machines;
            }
        }

        $maxArray3 = sizeof($array3);


        if($maxArray3 != 0)
        {
            for($i =0; $i < $maxArray3; $i++){
                // return $uniao[$i];
                $allmachineswithowner2 = machinesallinfos::find($array3[$i]);
                $showFilteredMachines[] =  $allmachineswithowner2;
                $showFilteredMachinesStatus = true;

            }
        }

        else{
            $allmachineswithowner2 = machinesallinfos::where('owner', 'LIKE', $id)->get();
            $showFilteredMachinesStatus = false;
            $showFilteredMachines[] =  0;

        }

        // return $showFilteredMachines;

        $workorder_payments = allwkpaymentsinfos::where('customerId', 'LIKE', $id)->get();
        $findNewTelephones = newtelephones::where('owner_id', 'LIKE', $id)->get();

        //  $ProductsInfos2 = allinfosproductssales::where('salesId', 'LIKE', "%{$salesId}%")->get();
        $allsales = allasales::where('chooseCustomer','LIKE',$id)->get();


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


        return view('sections.customers.viewPage.index', compact('thisCustomer','allmachineswithowner','workorder_payments', 'allworkOrders', 'findNewTelephones', 'allmachineswithowner2',
         'Nappointments', 'showFilteredMachines', 'showFilteredMachinesStatus', 'allsales', 'NthisCustomerMachines', 'NthisCustomerWK', 'NbikesBought', 'NthisCustomerProductsBought'));
    }


    //PAYMENTS E OS DETAILS




    public function update(CustomerEditFormRequest $request, $id)
    {
        $customerId =  $request->customerId;
        $created_at = date("Y/m/d");
        $newtelephones = $request->newtelephones;

        $findDatasonRelationTable = newtelephones::where('owner_id', 'LIKE', $id)->first();

        //puxando os produtos existentes na tabela de relação
        // $findDatasonRelationTable = products_machines::where('product_id', 'LIKE', $id)->first();

        // return $a=[$newtelephones, $findDatasonRelationTable];


        if ($request->StatusbackRoute == 'customerIndex' ){
            $routeURL = 'section/customers/';
        }
        // else if ($request->StatusbackRoute == 'customerViewPage'){
        //      $routeURL = '/section/customers/viewPage/'.$customerId;
        // }
        else{
             $routeURL = '/section/customers/viewPage/'.$customerId;
        }



            // 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email'
            $customer = Customer::find($id);

            // if ($path = $request->file('image')== null)
            // $path = $customer->image;

            // else
            // $path = $request->file('image')->store('images','public');

            $request->file('image') == null ?  $path = $customer->image : $path = $request->file('image')->store('images','public');
            $request->file('proofOfAddress') == null ?  $pathProofAddress = $customer->proofOfAddress : $pathProofAddress = $request->file('proofOfAddress')->store('proofOfAddress','public');
            $request->file('idimage') == null ?  $pathidImage = $customer->idimage : $pathidImage = $request->file('idimage')->store('idimage','public');
            // $request->file('image') == null ?  $path = $customer->image : $path = $request->file('image')->store('images','public');
            // $request->proofOfAddress == null ? $pathProofAddress =  "default.png" : $pathProofAddress = $pathProofAddress;1
            // $request->proofOfAddress == null ? $pathProofAddress =  "default.png" : $pathProofAddress = $pathProofAddress;


            if(isset($customer)){
            $customer->image = $path;
            $customer->proofOfAddress = $pathProofAddress;
            $customer->idimage = $pathidImage;
            $customer->name = $request->input('name');
            $customer->telephone = $request->input('telephone');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $updatecustomers = $customer->save();


            if(!isset($newtelephones)){
                // return 1;
                //se nenhum producto for selecionada, seja removida ou nao
                if($findDatasonRelationTable){$deleteproducts = newtelephones::where('owner_id', 'LIKE', $id)->delete();}

                return redirect()
                ->to($routeURL)
                ->with('success',  'The customer was successful update' );

            }


            if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                // create
                // return 2;
                    foreach ($newtelephones as $key => $prodObj){
                        $vals = $request->newtelephones;
                        $product_machine = DB::insert('insert into newtelephones (telephoneNumber, owner_id, created_at, updated_at) values (?, ?, ?, ?)', [$prodObj, $customerId, $created_at, $created_at]);
                    }
            }

            else{
                //update  ->delete and create
                // return 3;
                $deleteproducts = newtelephones::where('owner_id', 'LIKE', $id)->delete();
                if($deleteproducts){
                    foreach ($newtelephones as $key => $prodObj){
                        $vals = $request->newtelephones;
                        $product_machine = DB::insert('insert into newtelephones (telephoneNumber, owner_id, created_at, updated_at) values (?, ?, ?, ?)', [$prodObj, $customerId, $created_at, $created_at]);
                    }
                }
            }



            if($updatecustomers){
            return redirect()
                        ->to($routeURL)
                        ->with('success',  'The customer was successful update' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }

    public function allbikescustomers(){
        return 1;
    }

    public function destroy($id)
    {
        // deletando tudo que tenha de referencia aos clientes
        //cliente
        $deletecustomer = Customer::find($id)->delete();
        $findWorkOrder = WorkOrder::where('customer', 'LIKE', $id)->get();
        $findQuote = Quote::where('customer', 'LIKE', $id)->get();
        $findMachine = Machine::where('owner', 'LIKE', $id)->get();

        // $attCustomers = Customer::all();
        // return response()->json($statusSearch);

        if($deletecustomer){

            if($findWorkOrder){
                //workorder
                {$delteworkOrder = WorkOrder::where('customer', 'LIKE', $id)->delete();}
            }

            if($findMachine){
                //workorder
                {$delteworkOrder = Machine::where('owner', 'LIKE', $id)->delete();}
            }

            if($findQuote){
                //quotes
                {$delteQuote = Quote::where('customer', 'LIKE', $id)->delete();}
            }

            return redirect()
                        ->route('customer.index')
                        ->with('success',  'The Customer was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }


    public function searchCustomerAjaxByFilters(Request $request)
    {
        $searchInput = $request->searchInput;
        $filteredBy = $request->filteredBy;
        $ascOrDesc = $request->ascOrDesc;

        $allcustomers = Customer::where('name', 'LIKE', "%$searchInput%")
        ->orWhere('id','LIKE', "%$searchInput%")
        ->orWhere('email','LIKE', "%$searchInput%")
        ->orWhere('telephone','LIKE', "%$searchInput%")
        ->OrderByRaw($filteredBy . ' '. $ascOrDesc)
        ->get();
        return $allcustomers;

    }

}
