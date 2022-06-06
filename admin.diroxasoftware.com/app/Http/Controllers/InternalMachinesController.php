<?php

namespace App\Http\Controllers;

use App\internalmachines;
use App\machinesallinfos;
use App\Customer;
use App\ShowProductsByMachines;
use App\productsAllinfos;
use App\accessproductsbyinternalmachines;
use App\Product;
use Illuminate\Http\Request;
use DB;
use App\products_machines;
use App\productsmachinesallinfos;
use App\Http\Requests\Internal\InternalMachinesFormRequest;
use App\Http\Requests\Internal\InternalMachinesEditFormRequest;
use Image;
use App\hiringmachines;
use App\paymentshiringmachine;
use App\overviewpricesinfoshiremachines;
use App\allhiringmachinesinfos;
use App\outgoing;


class InternalMachinesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $allmachines = internalmachines::all();
         $allproducts = Product::all();
        return view('sections.machines.internalMachines.index', compact('allmachines', 'allproducts'));
    }

    public function storeAjax(Request $request)
    {
        $createMachine = internalmachines::create($request->all());
        if($createMachine)
        {
            $idNewInternalMachine =  $createMachine->id;
            // vamos retornar o valor da nova maquina cadastrada agora mesmo para ja adicionar na tabela
            return $allmachines = internalmachines::find($idNewInternalMachine);
        }
        else{
            return dd("Something went wrong. Try again");
        }

    }


    public function create($from = null){

        if($from == 'indexInternalMachines'){
            $allproducts = Product::all();
            $backRoute = 'indexInternalMachines';
            return view('sections.machines.internalMachines.create', compact('allproducts', 'backRoute'));
        }
        else{
                $allproducts = Product::all();
                $backRoute = 'outraRoute';
                return view('sections.machines.internalMachines.create', compact('allproducts', 'backRoute'));
        }

    }


    public function store(InternalMachinesFormRequest $request)
   {

       $addtooutgoing = $request->outgoingcheck;
       $condition = $request->condition;
       $typemachine = $request->typemachine;
       $request->brand == null ? $brand =  'Machine brand' : $brand = $request->brand;
       $Receivedimage = $request->machineImage;

       if($Receivedimage){
           $path =  $request->file('machineImage')->store('images','public');
           $input['machineImage'] = $path;
           $img = Image::make('storage/'. $path);
           $img->resize(2, 2);
       }

       $request->machineImage == null ? $path =  "default.png" : $path = $path;

       $createInternalMachine = new internalmachines();
       $createInternalMachine->serial_number = $request->input('serial_number');
       $createInternalMachine->model = $request->input('model');
       $createInternalMachine->brand = $brand;
       $createInternalMachine->valueMachine =  $request->input('valueMachine');
       $createInternalMachine->costMachine =  $request->input('costMachine');
       $createInternalMachine->quantity =  $request->input('quantity');
       $createInternalMachine->image =  $path;
       $creteIntmachine = $createInternalMachine->save();

       if(isset($addtooutgoing)){
           // add na tabela de outgoing
           $Cost_Price = $request->input('costMachine');
           $quantity = $request->input('quantity');
           $totalCost  = $Cost_Price * $quantity;

           $outgoing = new outgoing();
           $outgoing->name = $request->input('model');
           $outgoing->code = $createInternalMachine->id;
           $outgoing->outgoingCategory = 4; // That's means Motorcycles
           $outgoing->brand = $brand;
           $outgoing->Cost_Price = $totalCost;
           $outgoing->quantity = $quantity;
           $outgoing->about = "Motorcycle Selling";
           $outgoing->condition = "NEW";
           $addoutgoing = $outgoing->save();
       }

          return redirect()
               ->route('internalmachines.index')
               ->with('success',  'The Machine was successfull created!' );

}


    public function edit($id, $from = null)
    {

        $allmachines = internalmachines::find($id);
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
        $thisTypeMachine = $allmachines->typemachine;
        $crossHireMachinePrice = $allmachines->crossHireMachinePrice;
        $crossHireMachinePrice = number_format($crossHireMachinePrice, 2, '.',',');


        return view('sections.machines.internalMachines.edit', compact('allmachines', 'allcustomers', 'nameOwnerMachine', 'IdOwnerMachine', 'opcoesMarcadas', 'respostaProducts', 'statusNulo', 'allproducts', 'outrasop', 'from', 'thisMachineCondition', 'thisTypeMachine', 'crossHireMachinePrice'));
       }


    public function destroy($id)
    {
        $deletemachine = internalmachines::find($id)->delete();
        {$deleteproducts = products_machines::where('machine_id', 'LIKE', $id)->delete();}

        if($deletemachine){
            return redirect()
                    ->route('internalmachines.index')
                    ->with('success',  'The Machine was successful removed !');
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }


    public function update(InternalMachinesEditFormRequest $request, $id)
    {

        $thisMachineCondition = $request->condition;
        $condition = $request->condition;
        $typemachine = $request->typemachine;
        $crossHireMachinePrice = $request->crossHireMachinePrice;
        $request->crossHireMachinePrice == null ? $crossHireMachinePrice =  0 : $crossHireMachinePrice = $request->crossHireMachinePrice;
        $request->brand == null ? $brand =  'Machine brand' : $brand = $request->brand;

        $machine = internalmachines::find($id);

        $request->file('machineImage') == null ?  $path = $machine->image : $path = $request->file('machineImage')->store('images','public');


        // 'plate', 'brand',  'model', 'colour', 'year', 'owner'
            if(isset($machine)){
            $machine->serial_number = $request->input('serial_number');
            $machine->brand = $request->input('brand');
            $machine->model = $request->input('model');
            $machine->valueMachine =  $request->input('valueMachine');
            $machine->costMachine =  $request->input('costMachine');
            $machine->image = $path;
            $updatemachines = $machine->save();



            if($updatemachines){

                $Productsoptions =  $request->Productsoptions;
                $MachineId = $machine->id;
                $created_at = $machine->created_at;
                $updated_at = $machine->updated_at;

                 $findDatasonRelationTable = products_machines::where('machine_id', 'LIKE', $id)->first();

                if(!isset($Productsoptions)){
                    //se nenhum producto for selecionada, seja removida ou nao
                    if($findDatasonRelationTable){$deleteproducts = products_machines::where('machine_id', 'LIKE', $id)->delete();}

                    return redirect()
                        ->route('internalmachines.index')
                        ->with('success',  'The Machine was successfull updated!' );
                }


                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // create
                    foreach ($Productsoptions as $key => $prodObj){
                    $vals = $request->Productsoptions;
                    $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$MachineId, $prodObj, $created_at, $updated_at]);
                    }
                }

                else{
                    //update  ->delete and create
                    $deleteproducts = products_machines::where('machine_id', 'LIKE', $id)->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$MachineId, $prodObj, $created_at, $updated_at]);
                        }
                    }
                }

                return redirect()
                        ->route('internalmachines.index')
                        ->with('success',  'The Machine was successfull updated!' );

            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }

    }


    public function view($id, $from= null)
    {

      
      $allmachines = internalmachines::find($id);

      $ownerId = $allmachines->owner;

      $nameOwner = $allmachines->customerName;

      $allproducts = productsAllinfos::all();

      $ProductsByMachines = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', $id)->get();

      $MoreInfos = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', $id)->first();


      return view('sections.machines.internalMachines.view', compact('allmachines','ProductsByMachines', 'nameOwner', 'allproducts', 'from'));

    }
}
