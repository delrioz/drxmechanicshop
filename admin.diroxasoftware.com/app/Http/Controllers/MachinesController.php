<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Machine;
use App\Customer;
use App\ShowProductsByMachines;
use App\machinesallinfos;
use App\Product;
use App\allquotesinformations;
use App\allworkorderinformations;
use App\Http\Requests\Customer\MachineFormRequest;
use App\Http\Requests\Customer\MachineEditFormRequest;
use App\workorder_payments;
use App\workorder_invoice;
use App\totalprodsSelectedWK;
use DB;
use App\overviewbetweenworkorderandproductsqts;
use App\showonoverviewworkorders;
use App\openworkorder;
use App\Quote;
use App\WorkOrder;
use App\products_machines_workorders;
use App\products_machines_quotes;
use App\totalextraitemsworkOrderId;
use App\extraitems;
use App\allwkpaymentsinfos;
use App\previewreturnmachine;


class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id = null)
    {


        if($id == null){
            $allmachines = Machine::all();
            $allmachineswithowner = machinesallinfos::all();
            $allworkOrders = allworkorderinformations::get();
            $thisCustomer = 0;
            $thisCustomerStatus = 0;
            $Nappointments = 0;

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
        }
        else{

            $thisCustomer = Customer::find($id);
            // COUNT TABLES
            $allmachines = Machine::where('owner', $id)->get();
            $allmachineswithowner = machinesallinfos::where('customerId', $id)->get();
            $allworkOrders = allworkorderinformations::where('customerId', $id)->get();
            $thisCustomerStatus = 1;

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



        return view('sections.machines.index', compact('allmachines', 'allmachineswithowner', 'allworkOrders', 'NthisCustomerMachines',
                    'NthisCustomerWK', 'NbikesBought', 'Nappointments',
                    'NthisCustomerProductsBought', 'thisCustomer', 'thisCustomerStatus'));
    }

    public function create($from = null)
    {

        $latestMachine = machinesallinfos::latest()->first();


        if($from == 'welcomePage'){
            $allcustomers = Customer::all();
            $backRoute = "welcomePage";
            return view('sections.machines.create', compact('allcustomers', 'backRoute', 'latestMachine'));
        }
        else if($from == 'generalSearchPage'){

            $allcustomers = Customer::all();
            $backRoute = "generalSearchPage";
            return view('sections.machines.create', compact('allcustomers', 'backRoute', 'latestMachine'));
        }
        else{

            $allcustomers = Customer::all();
            $backRoute = "customerIndex";

             $latestMachine;

            return view('sections.machines.create', compact('allcustomers', 'backRoute', 'latestMachine'));
        }
    }



    public function store(MachineFormRequest $request)
    {

        // $newMachine = Machine::create($request->all());
        $request->serial_number == null ? $serial_number =  "standard" : $serial_number = $request->serial_number;
        $request->model == null ? $model =  "standard" : $model = $request->model;
        $request->brand == null ? $brand =  "standard" : $brand = $request->brand;
        $request->mileage == null ? $mileage =  "0" : $mileage = $request->mileage;
        $request->observations == null ? $observations =  "no observations" : $observations = $request->observations;
        $owner = $request->owner;

        $createCustomerMachine = new Machine();
        $createCustomerMachine->serial_number = $serial_number;
        $createCustomerMachine->model = $model;
        $createCustomerMachine->owner = $owner;
        $createCustomerMachine->mileage = $mileage;
        $createCustomerMachine->brand = $brand;
        $createCustomerMachine->observations = $observations;
        $createMachine = $createCustomerMachine->save();

        $idMachine = $createCustomerMachine->id;


        // to where will redirect when the machine is created
        // return redirect()->route('machine.index');
        // return redirect()->route('customer.index');

        return redirect()
                    ->route('machine.viewPage', ['id' => $idMachine])
                    ->with('success',  'The Motorcycle was successful created');


            return redirect()
                        ->back()
                        ->with('error', $response['message']);
    }



    public function edit($id, $from = null)
    {


        if($from == null){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'customerMachineIndex';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'MachineViewPage'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'customerMachineViewPage';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }

        else if($from == 'customerMachineIndex'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'customerMachineIndex';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'generalSearchPage'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'generalSearchPage';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'customerIndexViewPage'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'customerIndexViewPage';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'machineOverviewPage'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'machineOverviewPage';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'indexMachine'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $backRoute = 'indexMachine';
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
        }
        else if($from == 'customerindexMachine'){
            $allmachines = machinesallinfos::find($id);
            $allcustomers = Customer::all();
            $nameOwnerMachine = $allmachines->customerName;
            $IdOwnerMachine = $allmachines->customerId;
            $backRoute = "customerindexMachine";
            $from = "/section/machines/" . $IdOwnerMachine;
        }


        // return $from;


        return view('sections.machines.edit', compact('from', 'allmachines', 'allcustomers', 'nameOwnerMachine', 'IdOwnerMachine', 'backRoute'));
    }


    public function view($id)
    {

      $allmachines = machinesallinfos::find($id);

      $ownerId = $allmachines->owner;

      $nameOwner = $allmachines->customerName;


      $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', '=', $id)->get();

      $MoreInfos = ShowProductsByMachines::where('machineIdinMachine', '=', $id)->get();

      return view('sections.machines.view', compact('allmachines','ProductsByMachines', 'nameOwner'));
    }



    public function viewPage($id)
    {   

        
        try{
            // infos to show in the header

            // $allmachines = Machine::where('owner', '=', $id)->get();

            $machineId = $id;

            $allmachines = Machine::find($id);

            $allmachineswithowner = machinesallinfos::find($id);


            // products in this machine
            $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', '=', $id)->get();

            // quotes
            $allQuotes = allquotesinformations::where('machine' , '=',  $id)->where('status', '!=', '1')->get(); // status 2 means status closed

            // AS SELECT w.id AS id, w.title AS title, w.customer_report AS customer_report, w.first_observations AS first_observations, w.last_observations AS last_observations, w.customer AS customer, w.machine AS machine, w.status AS status, w.typeofpayment AS typeofpayment, w.price AS price, w.created_at AS created_at, w.updated_at AS updated_at, m.id AS machineId, m.model AS machineModel, c.id AS customerId, c.name AS customerName, c.email AS customerEmail, c.telephone AS customerTelephone, c.address AS customerAdress FROM ((work_order w join machines m) join customers c) WHERE w.machine = m.id AND w.customer = c.id ;
            // work orders
            $allworkOrders = allworkorderinformations::where('machineId' , '=',  $id)->where('status', '!=', '1')->get();


            // $workorder_payments = workorder_payments::where('machineId', '=', $id)->get();
            $workorder_payments= allwkpaymentsinfos::where('machineId', '=', $id)->get();


            $NwkMade = WorkOrder::select(DB::raw('COUNT(*) AS total'))
                ->where('status', '=', 1 )
                ->where('machine', '=', $id)
                ->get()[0];
            $NwkMade = $NwkMade-> total;

            $NquoteMade = Quote::select(DB::raw('COUNT(*) AS total'))
                ->where('status', '=', 1 )
                ->where('machine', '=', $id)
                ->get()[0];
             $NquoteMade = $NquoteMade-> total;


            $allproducts = Product::all();

            return view('sections.machines.viewPage.index',
                compact('allworkOrders','NquoteMade', 'NwkMade','allQuotes', 'ProductsByMachines',  'allmachines', 'allmachineswithowner','allproducts', 'workorder_payments', 'machineId'));
        }


        catch(Exception $e){
            return redirect()
            ->back()
            ->with('warning',  'Was not possible to access this machine' );
        }
    }



    public function destroy($id, $from = null)
    {

        if($from == "machineOverviewPage")
        {
            $findthisMachineDatas = Machine::find($id);
            $idOwner =  $findthisMachineDatas->owner;
            $routeURL = '/section/machines/'. $idOwner;
        }
        else if($from ==  'customerIndexViewPage')
        {
            $findthisMachineDatas = Machine::find($id);
            $idOwner =  $findthisMachineDatas->owner;
            $routeURL = '/section/customers/viewPage/'. $idOwner;
        }
        else if($from ==  'customerindexMachine')
        {
            $findthisMachineDatas = Machine::find($id);
            $idOwner =  $findthisMachineDatas->owner;
            $routeURL = '/section/machines/'. $idOwner;
        }

        else
        {
            $routeURL = 'section/machines/';
        }


        try{
                $deletemachine = Machine::find($id)->delete();
                $deletequote = Quote::where('machine', '=', $id)->delete();
                $deletewk = WorkOrder::where('machine', '=', $id)->delete();
                $deletepw = products_machines_workorders::where('machine_id', '=', $id)->delete();
                $deletepq = products_machines_quotes::where('machine_id', '=', $id)->delete();
                {$deleteworkOrderPayments = workorder_payments::where('machineId', '=', $id)->delete();}
                {$deleteworkorderinvoice = workorder_invoice::where('machineId', '=', $id)->delete();}

                if($deletemachine){
                    return redirect()
                                ->to($routeURL)
                                ->with('success',  'The Motorcycle was successful removed !' );
                    }


                    else
                    {
                        return redirect()
                                    ->back()
                                    ->with('error', $response['message']);

                    }

        }
                    catch(Exception $e){
                            return redirect()
                            ->back()
                            ->with('warning',  'Was not possible delete this machine' );
        }

    }



    public function update(MachineEditFormRequest $request, $id)
    {
        // customerMachineIndex, customerMachineViewPage
        // return $id;
        // return 1;


        $machineId =  $request->machineId;
        $request->StatusbackRoute;
        $owner = $request->owner;
        // return 1;

        if ($request->StatusbackRoute == 'customerMachineIndex' ){
            $routeURL = 'section/machines/';
        }
        else if ($request->StatusbackRoute == 'customerMachineViewPage'){
             $routeURL = '/section/machines/viewPage/'.$machineId;
        }
        else if ($request->StatusbackRoute == 'customerIndexViewPage'){
             $routeURL = '/section/customers/viewPage/'.$owner;
        }
        else if ($request->StatusbackRoute == 'machineOverviewPage'){
             $routeURL = '/section/machines/'.$owner;
        }
        else if ($request->StatusbackRoute == 'indexMachine'){
             $routeURL = '/section/machines/';
        }
        else if ($request->StatusbackRoute == 'customerindexMachine'){
             $routeURL = '/section/machines/'.$owner;
        }




        // 'plate', 'brand',  'model', 'colour', 'year', 'owner'
        $machine = Machine::find($id);
            if(isset($machine)){
            $machine->serial_number = $request->input('serial_number');
            $machine->brand = $request->input('brand');
            $machine->model = $request->input('model');
            $machine->owner = $request->input('owner');
            $machine->mileage = $request->input('mileage');
            $machine->observations = $request->input('observations');
            $updatemachines = $machine->save();


            if($updatemachines){
                $machineOwner = $machine->owner;
                return redirect()
                            // ->route('customer.viewPage', ['id' => $machineOwner])
                            ->to($routeURL)
                            ->with('success',  'The Motorcycle was successful updated');
            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
            }
        }

    }


    public function viewinvoice($id)
    {


            
            // pegando dados do invoice
            $findThisWkInfos = workOrder::find($id);
            $newInvoice =  workorder_invoice::where('workOrderReference', '=', $id)->first();


            if($findThisWkInfos == null){
                return redirect()
                ->back()
                ->with('error',  'This information is not available anymore on your database.' );
            }

    

            else {

            $bikemileage = $findThisWkInfos->mileage;

            // id e workorderreference [e a mesma coisa no contexto ]
            $newInvoice =  workorder_invoice::where('workOrderReference', '=', $id)->first();
            $machineId = $newInvoice->machineId;
            $workOrderReference = $newInvoice->workOrderReference;

            $quoteReference = $newInvoice->quoteReference;
            $workOrderReference = $newInvoice->workOrderReference;
            $createInvoice = $newInvoice->save();


            $findthisoverview = totalprodsSelectedWK::where('workOrderId', '=', $id)->first();


            if($findthisoverview != null || $findthisoverview != "")
            {
                $amountProducts = $findthisoverview->totalProductsonThisWk;
            }


            // id e workorderreference [e a mesma coisa no contexto ]
            $workOrderReference = $id;
            $newInvoiceId =  $newInvoice->id;
            // $newInvoiceCreatedDate =  $request->newInvoiceCreatedDate;

            // retornando dados desse invoice

            // $findinvoice = workorder_invoice::find($newInvoiceId)->first();
            $findinvoice = ( DB::select('SELECT * from workorder_invoice where  id =' . $newInvoiceId )[0]);

            $invoicecreatedate = $findinvoice->created_at;

            // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
            $Machine_Id =  $machineId;
            $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
            $machine_model = ($machine_info->model);
            $machine_brand = ($machine_info->brand);
            $entry_machine_date = ($machine_info->created_at);
            $entry_machine_date =  date('d/m/Y', strtotime($entry_machine_date));



            // infomações das work orders
            // $allworkOrders = allworkorderinformations::whereRaw('machineId= ' . $Machine_Id)->first();
            // $allworkOrders = ( DB::select('SELECT * from allworkorderinformations where machineId =' . $workOrderReference )[0]);
            $allworkOrders = ( DB::select('SELECT * from allworkorderinformations where id =' . $workOrderReference )[0]);



            // WorkOrder

            // $workorder = WorkOrder::find($id)->get();
            //  $workorder = allworkorderinformations::where('id', '=', $id)->find();
            $workorder = ( DB::select('SELECT * from allworkorderinformations where id =' . $workOrderReference )[0]);


            // $workorder = WorkOrder::find($id)->first()
            $wkId =  $workorder->id;
            $typeofpayment =  $workorder->typeofpayment;
            $nameCustomer =  $workorder->customer;
            $dataConfirmPay = $workorder;
            $product = $dataConfirmPay->title;
            $customer_report = $workorder->customer_report;
            $last_observations = $workorder->last_observations;
            $newInvoiceCreatedDate =  $workorder->created_at;

            $wkcreatedAt =  date('d/m/Y', strtotime($workorder->created_at));
            $wkcreatedAtStart =  $wkcreatedAt;


            // achando os valores na products workorders de acordo com o id da workorder dessa pagina
            //  $ProductsInfo2 = products_on_workorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();

            // acha as peças na maquina where o id da work order for a mesma q a workorder atual
            $ProductsInfo = overviewbetweenworkorderandproductsqts::where('workOrderId', '=', $id)->get();

            $ProductsInfo2 = overviewbetweenworkorderandproductsqts::where('workOrderId', '=', $id)->get();


            // retornando os valores que vao para o card geral dessa ordem de serviço
            $showonoverviewworkorders = showonoverviewworkorders::whereRaw('workOrderReference = ' . $workOrderReference)->get();


            $workorder_payments= workorder_payments::where('workOrderReference', '=', $id)->first();


            // return
            // DADOS EM GERAL
            if($workorder_payments == ""){
                return redirect()
                            ->back()
                            ->with('error', 'Error Try again later. Seems like the payment was deleted so we cannot show the invoice anymore.');
            }

            $vat = $workorder_payments->vat;
            $amount = $workorder_payments->amount;
            $discount = $workorder_payments->discount;
            $totalWithVAT = $workorder_payments->totalWithVAT;
            $amountProducts = $workorder_payments->amountProducts;
            $worklabor = $workorder_payments->worklabor;
            $typeofpayment = $workorder_payments->typeofpayment;
            $SubTotalFormated =$amount + $worklabor;


                //LOGICA PARA CASO TENHA OU SOMENETE EXTRA  ITEMS OU SOMENTE A MÃO DE OBRA
                    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', '=', $id)->first();
                    $findthisoverview = totalprodsSelectedWK::where('workOrderId', '=', $id)->first();

                    if($findthisoverview == "" || $findthisoverview == null ){
                            // return "sem produto";

                                if($findthisoverviewExtraItems == "" || $findthisoverviewExtraItems == null)
                                {

                                        // return "only service";
                                        // return redirect()
                                        // ->back()
                                        // ->with('error', 'estamos em manutenção....');

                                        //88 Sumario o VAT QUE VEM DO workorder payments é somente o vat em si da compra do total - disconto
                                        // discount -> só o valor do disconto em si
                                        // totalWithVAT-> É O VALOR FINAL, OU SEJA É O VALOR DA VENDA - DISCONTO  + O VAT
                                        // VAT É CALCULADO PELO PREÇO DA WORKORDER - DISCONTO DEPOIS O MESMO É SOMADO AO totalWithVAT

                                        $amountwithoutproducts = $SubTotalFormated; // AMOUNT É O SUBTOTAL
                                        // $machineId = $request->machine;
                                        // $typeofpayment = $request->typeofpayment;
                                        // $discount = $request->discount;
                                        // $workOrderReference = $request->id;
                                        // $worklabor = $request->worklabor;
                                        $totalExtraItemsStatus = "empty";

                                        $SubTotalFormated = $worklabor; // SOMANDO COM O TOTAL DOS VALORES EXTRAS
                                        $SubTotalFormated = number_format($SubTotalFormated, 2, '.',',');
                                        // $totalExtraItemsVAT = number_format($totalExtraItemsVAT, 2, '.',',');
                                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                                        $vat = number_format($vat, 2, '.',',');
                                        $worklabor = number_format($worklabor, 2, '.',',');
                                        $discount = number_format($discount, 2, '.',',');
                                        $onlyServiceMsg = "enabled";
                                        $ProductsSatus = "empty";


                                        return view('sections.payments.paymentsConfirmed', compact('bikemileage', 'entry_machine_date', 'dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'workorder_payments', 'amountProducts', 'wkId', 'Machine_Id', 'machine_model', 'machine_brand', 'workOrderReference', 'wkcreatedAtStart', 'vat', 'amount', 'discount', 'totalWithVAT', 'amountProducts', 'worklabor', 'typeofpayment', 'SubTotalFormated', 'totalExtraItemsStatus', 'onlyServiceMsg'));


                                    }

                                    else{

                                        // ONLY EXTRA ITEMS

                                        // return "only extra items";
                                        $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', '=', $id)->first();
                                        $amountExtraItemsWithoutVat  = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;

                                        // return redirect()
                                        // ->back()
                                        // ->with('error', 'estamos em manutenção....');


                                        $vat = $workorder_payments->vat;
                                        $amount = $workorder_payments->amount;
                                        $discount = $workorder_payments->discount;
                                        $totalWithVAT = $workorder_payments->totalWithVAT;
                                        $amountProducts = $workorder_payments->amountProducts;
                                        $worklabor = $workorder_payments->worklabor;
                                        $typeofpayment = $workorder_payments->typeofpayment;
                                        $SubTotalFormated =$amount + $worklabor;


                                        $workOrderId = $findthisoverviewExtraItems->workOrderId;

                                        $SubTotalFormated = number_format($amount, 2, '.',',');
                                        $vat = number_format($vat, 2, '.',',');
                                        $amount = number_format($amount, 2, '.',',');

                                        $worklabor = number_format($worklabor, 2, '.',',');
                                        $discount = number_format($discount, 2, '.',',');
                                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                                        $amountProducts = number_format($amountProducts, 2, '.',',');
                                        $worklabor = number_format($worklabor, 2, '.',',');
                                        $totalExtraItemsStatus = "setup";
                                        $findWkInvoiceId = $id;
                                        $allextraitems = extraitems::where('workOrderId', '=', $findWkInvoiceId)->get ();
                                         // indica que ta sem produtos


                                        return view('sections.payments.paymentsConfirmed', compact('bikemileage', 'entry_machine_date', 'dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'workorder_payments', 'amountProducts', 'wkId', 'Machine_Id', 'machine_model', 'machine_brand', 'workOrderReference', 'wkcreatedAtStart', 'vat', 'amount', 'discount', 'totalWithVAT', 'amountProducts', 'worklabor', 'typeofpayment', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems'));



                            }
                        }


                // FIM LOGICA PARA CASO TENHA OU SOMENETE EXTRA  ITEMS OU SOMENTE A MÃO DE OBRA

                    // extraitems -> caso tenha EXTRA ITEMS

                    // o total dos extraitems somados
                    $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', '=', $workOrderReference)->first();
                    if($findthisoverviewExtraItems == null){

                        // return "sem extra items";

                        // EXTRASALES, PRODUCTS AND WORKORDERS
                        $worklabor = $workorder_payments->worklabor;
                        $vat = $workorder_payments->vat;
                        $amount = $workorder_payments->amount; // subtotal
                        $discount = $workorder_payments->discount;
                        $totalWithVAT = $workorder_payments->totalWithVAT;

                        //prods nessa ordem
                        $amountProducts = $findthisoverview->totalProductsonThisWk;
                        $subtotal = $worklabor  + $amountProducts;
                        $vat = ($subtotal * 0.20);
                        $subtotalWithVAT = $subtotal + $vat;
                        $totalWithVAT = $subtotalWithVAT - $discount;


                        // vat total *tirando os produtos que ja vieram com vat *
                        $SubTotalFormated = number_format($subtotal, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($amount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $amountProducts = number_format($amountProducts, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');

                        // quando  nao tiver extraitems vamos setar o valor para 0;
                        $totalExtraItemsVAT = 0;
                        $totalExtraItemsStatus = "empty";

                        $allextraitems = extraitems::where('workOrderId', '=', $workOrderReference)->get ();
                        //endextraitems
                        return view('sections.payments.paymentsConfirmed', compact('bikemileage', 'entry_machine_date', 'dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'workorder_payments', 'amountProducts', 'wkId', 'Machine_Id', 'machine_model', 'machine_brand', 'workOrderReference', 'wkcreatedAtStart', 'vat', 'amount', 'discount', 'totalWithVAT', 'amountProducts', 'worklabor', 'typeofpayment', 'SubTotalFormated', 'totalExtraItemsStatus', 'allextraitems'));



                    }
                    else{

                        // se tiver algum produto com valor extra cadastrado
                        // $totalWithVAT = $findthisoverviewExtraItems->totalWithVAT + $totalExtraItemsVAT;

                        //extraitems
                        $findthisoverviewExtraItems = totalextraitemsworkOrderId::where('workOrderId', '=', $id)->first();
                        // $amountExtraItemsWithoutVat  = $findthisoverviewExtraItems->totalExtraItemsWithoutVat;
                        $totalExtraItemsWithoutVAT = $findthisoverviewExtraItems->totalExtraItemsWithoutVAT;

                        //prods
                        $findthisoverview = totalprodsSelectedWK::where('workOrderId', '=', $id)->first();
                        $amountProducts = $findthisoverview->totalProductsonThisWk;

                        $worklabor = $workorder_payments->worklabor;
                        $vat = $workorder_payments->vat;
                        $amount = $workorder_payments->amount; // subtotal
                        $discount = $workorder_payments->discount;
                        $totalWithVAT = $workorder_payments->totalWithVAT;

                        $subtotal = $worklabor + $totalExtraItemsWithoutVAT + $amountProducts;
                        $vat = ($subtotal * 0.20);
                        $subtotalWithVAT = $subtotal + $vat;
                        $totalWithVAT = $subtotalWithVAT - $discount;


                        $workOrderId = $findthisoverviewExtraItems->workOrderId;
                        $SubTotalFormated = number_format($subtotal, 2, '.',',');
                        $totalExtraItemsWithoutVAT = number_format($totalExtraItemsWithoutVAT, 2, '.',',');
                        $vat = number_format($vat, 2, '.',',');
                        $amount = number_format($amount, 2, '.',',');
                        $discount = number_format($discount, 2, '.',',');
                        $totalWithVAT = number_format($totalWithVAT, 2, '.',',');
                        $amountProducts = number_format($amountProducts, 2, '.',',');
                        $worklabor = number_format($worklabor, 2, '.',',');
                        $totalExtraItemsStatus = "setup";

                        $allextraitems = extraitems::where('workOrderId', '=', $workOrderReference)->get ();
                        //endextraitems
                        return view('sections.payments.paymentsConfirmed', compact('bikemileage', 'entry_machine_date', 'dataConfirmPay', 'nameCustomer', 'typeofpayment','ProductsInfo', 'allworkOrders', 'ProductsInfo2', 'showonoverviewworkorders','product','customer_report', 'last_observations', 'entry_machine_date', 'newInvoiceId', 'newInvoiceCreatedDate', 'invoicecreatedate', 'workorder_payments', 'amountProducts', 'wkId', 'Machine_Id', 'machine_model', 'machine_brand', 'workOrderReference', 'wkcreatedAtStart', 'vat', 'amount', 'discount', 'totalWithVAT', 'amountProducts', 'worklabor', 'typeofpayment', 'SubTotalFormated', 'totalExtraItemsStatus', 'totalExtraItemsWithoutVAT', 'allextraitems'));

            }
        }

    }

    public function subviewpage($id, $destiny =  null)
    {

        try{
            // infos to show in the header

            return "machine controller subviewpage";


            // $allmachines = Machine::where('owner', '=', $id)->get();
            $machineId = $id;

            $allmachines = Machine::find($id);

            $allmachineswithowner = machinesallinfos::where('id', '=', $id)->get();


            // products in this machine
            $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', '=', $id)->get();

            // quotes
            $allQuotes = allquotesinformations::where('machine' , '=',  $id)->where('status', '=', '0')->get();

            // AS SELECT w.id AS id, w.title AS title, w.customer_report AS customer_report, w.first_observations AS first_observations, w.last_observations AS last_observations, w.customer AS customer, w.machine AS machine, w.status AS status, w.typeofpayment AS typeofpayment, w.price AS price, w.created_at AS created_at, w.updated_at AS updated_at, m.id AS machineId, m.model AS machineModel, c.id AS customerId, c.name AS customerName, c.email AS customerEmail, c.telephone AS customerTelephone, c.address AS customerAdress FROM ((work_order w join machines m) join customers c) WHERE w.machine = m.id AND w.customer = c.i, 'totalExtraItemsStatus', 'totalExtraItemsVAT' ;
            // work orders
            $allworkOrders = allworkorderinformations::where('machineId' , '=',  $id)->where('status', '!=', '1')->get();


            $workorder_payments = workorder_payments::where('machineId', '=', $id)->get();

            $allproducts = Product::all();

            if($destiny == "quote"){
                return view('sections.machines.viewPage.subviewpage.quoteviewpage', compact('allworkOrders', 'allQuotes', 'ProductsByMachines',  'allmachines', 'allmachineswithowner','allproducts', 'workorder_payments', 'machineId'));
            }
            else if($destiny == "workOrder"){
                return view('sections.machines.viewPage.subviewpage.workOrderviewpage', compact('allworkOrders', 'allQuotes', 'ProductsByMachines',  'allmachines', 'allmachineswithowner','allproducts', 'workorder_payments', 'machineId'));
            }
            if($destiny == "payments"){
                return view('sections.machines.viewPage.subviewpage.paymentsViewpage', compact('allworkOrders', 'allQuotes', 'ProductsByMachines',  'allmachines', 'allmachineswithowner','allproducts', 'workorder_payments', 'machineId'));
            }

        }

        catch(Exception $e){
            return redirect()
            ->back()
            ->with('warning',  'Was not possible to access this machine' );
        }

    }


    public function searchingAjaxCustomerMachines(Request $request)
{
    $dataSearchResult =  $request->data;
    // if($dataSearchResult == '' || $dataSearchResult == null){
    //     return $allproducts = 0;
    // }
    // else{
    //     $allproducts = productsallinfos::where('name', 'LIKE', "%$dataSearchResult%")
    //                             ->orWhere('categoryName','LIKE', "%$dataSearchResult%")
    //                             ->orWhere('id','LIKE', "$dataSearchResult")
    //                             ->orWhere('SKU','LIKE', "%$dataSearchResult%")
    //                             ->orWhere('brand','LIKE', "%$dataSearchResult%")
    //                             ->orWhere('condition','LIKE', "$dataSearchResult")
    //                             ->get();
    //     return response()->json($allproducts);
    // }

    $allmachines = Machine::where('serial_number', 'LIKE', "%$dataSearchResult%")
            ->orWhere('brand','LIKE', "%$dataSearchResult%")
            ->orWhere('id','LIKE', "$dataSearchResult")
            ->orWhere('model','LIKE', "%$dataSearchResult%")
            ->get();

    return response()->json($allmachines);

}


    public function machinesfilter(Request $request)
    {
        $serialNumber = $request->serial_number;
        $model = $request->model;
        $brand = $request->brand;
        $owner = $request->owner;
        $createdAt = $request->created_at;
        $dataForm = "machines";


        // if(($dataForm == "machines")){
        //     $machinesSearch =  Machine::where(function ($query) use
        //     ($dataForm, $serialNumber, $model, $brand, $owner, $createdAt) {
        //     if($serialNumber != "aiaiai")  // vericamos se este valor existe (se esta inserido)
        //     $machinesSearch = $query->where('serial_number', 'LIKE', "%{$serialNumber}%");
        //   })->paginate(1000);


       return $machinesSearch = Machine::where('serial_number' , 'LIKE', "%{$serialNumber}%")
        ->where('model', 'LIKE', "%{$model}%")
        ->where('brand', 'LIKE', "%{$brand}%")
        ->where('owner', 'LIKE', "%{$owner}%")
        ->where('created_at', 'LIKE', "%{$createdAt}%")
        ->get();

        return view('sections.machines.index', compact('serialNumber','model', 'brand', 'owner', 'createdAt', 'dataForm'));            }

    // }
}
