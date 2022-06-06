<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Storage;
use Image;
use App\Category;
use App\Product_Machine;
use App\Machine;
use App\internalmachines;
use App\ShowMachinesByProducts;
use App\sales;
use App\outgoing;
use App\productsAllinfos;
use App\accessinternalmachinesbyproducts;
use App\products_machines;
use App\allasales;
use App\productSales;
use App\productsmachinesallinfos;
use App\Http\Requests\Internal\ProductFormRequest;
use App\Http\Requests\Internal\ProductAjaxFormRequest;
use App\Http\Requests\Internal\ProductEditFormRequest;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\supplier;



class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return redirect()->route('product.reports.index');
        $allproducts = productsAllinfos::orderByRaw('name ASC')->get();
        return view('sections.products.index', compact('allproducts'));
    }


    public function create($from = null)
    {
        // generalSearchPage
        $allSuppliers = supplier::all();

        if($from == "welcomePage"){
            $allproducts = Product::all();
            $allcategories = Category::orderByRaw('name ASC')->get();
            $allmachines = internalmachines::all();
            $backRoute = "welcomePage";
            return view('sections.products.create', compact('allproducts', 'allcategories', 'allmachines','backRoute', 'allSuppliers'));
        }
        else if($from == "generalSearchPage"){
            $allproducts = Product::all();
            $allcategories = Category::orderByRaw('name ASC')->get();
            $allmachines = internalmachines::all();
            $backRoute = "generalSearchPage";
            return view('sections.products.create', compact('allproducts', 'allcategories', 'allmachines','backRoute', 'allSuppliers'));
        }

        else{
            $allproducts = Product::all();
            $allcategories = Category::orderByRaw('name ASC')->get();
            $allmachines = internalmachines::all();
            $backRoute = "productIndex";
            return view('sections.products.create', compact('allproducts', 'allcategories', 'allmachines','backRoute', 'allSuppliers'));
        }



    }


    public function addProductsAjax(ProductAjaxFormRequest $request)
    {

        $Formname = $request->Formname;
        $FormSKU = $request->FormSKU;
        $Formcategory = $request->Formcategory;
        $Formbrand = $request->Formbrand;
        $FormSell_Price = $request->FormSell_Price;
        $FormSell_PriceVat = $request->FormSell_PriceVat;
        $Formquantity = $request->Formquantity;
        $Formcondition = $request->Formcondition;
        $Formsupplier = $request->Formsupplier;
        $FormCost_Price = $request->FormCost_Price;
        $addtooutgoing = $request->outgoingcheck;


        $vatFree = $request->vatFree;
        $supplier = $request->supplier;
        $category =  $request->category;


        $request->SKU == null ? $FormSKU =  'Product SKU' : $FormSKU = $request->FormSKU;
        $request->brand == null ? $Formbrand =  'Product brand' : $Formbrand = $request->Formbrand;


        if(isset($request->FormSell_PriceVat))
        {
            $isTheVatFree = "no"; //no
            $FormSell_PriceVat  = $request->FormSell_PriceVat;
        }
        else{
             $isTheVatFree = "yes"; //yes
             $FormSell_PriceVat  = $request->FormSell_Price;
        }


        // if($supplier == null || $category == null)
        // {
        //     return redirect()->back()->with('warning', 'You must choose a valid Supplier and Category!');
        // }



        $allproducts = new Product();
        $allproducts->name = $Formname;
        $allproducts->SKU = $FormSKU;
        $allproducts->category = $Formcategory;
        $allproducts->brand = $Formbrand;
        $allproducts->Sell_Price = $FormSell_Price;
        $allproducts->Sell_PriceVat = $FormSell_PriceVat;
        $allproducts->quantity = $Formquantity;
        $allproducts->condition = $Formcondition;
        $allproducts->supplier = $Formsupplier;
        $allproducts->Cost_Price = $FormCost_Price;
        $allproducts->about = 'nothing to add';
        $allproducts->image = "default.png";
        $allproducts->isTheVatFree = $isTheVatFree;
        $createProducts = $allproducts->save();


        $idNewProduct = $allproducts->id;

        $vals = $request->Machinesoptions;

        $created_at = $allproducts->created_at;
        $updated_at = $allproducts->updated_at;


        $addtooutgoing = $request->outgoingcheck;



        if($addtooutgoing == true){
            // add na tabela de outgoing
            $Cost_Price = $FormCost_Price;
            $quantity = $Formquantity;
            $totalCost  = $Cost_Price * $quantity;

            $outgoing = new outgoing();
            $outgoing->name = $Formname;
            $outgoing->code = $FormSKU;
            $outgoing->outgoingCategory = 3; // That's means Products
            $outgoing->brand = $Formbrand;
            $outgoing->Cost_Price = $totalCost;
            $outgoing->quantity = $quantity;
            $outgoing->about ="Nothing";
            $outgoing->condition = $Formcondition;
            $addoutgoing = $outgoing->save();
        }


        return $allproducts; // returning the product added

    }

    public function store(ProductFormRequest $request)
     {



        $vatFree = $request->vatFree;
        $supplier = $request->supplier;
        $category =  $request->category;

        if(isset($request->Sell_PriceVat))
        {
            $isTheVatFree = "no"; //no
            $Sell_PriceVat  = $request->input('Sell_PriceVat');
        }
        else{
             $isTheVatFree = "yes"; //yes
             $Sell_PriceVat  = $request->input('Sell_Price');
        }


        if($supplier == null || $category == null)
        {
            return redirect()->back()->with('warning', 'You must choose a valid Supplier and Category!');
        }

        $addtooutgoing = $request->outgoingcheck;

        $condition = $request->condition;

        $request->SKU == null ? $SKU =  'Product SKU' : $SKU = $request->SKU;
        $request->brand == null ? $brand =  'Product brand' : $brand = $request->brand;
        $request->about == null ? $about =  'nothing to add' : $about = $request->about;

        // $request->image == null ? $image =  'default.png' : $image = $request->image;
        $Receivedimage = $request->image;


         //se nenhuma maquina tiver sido selecionada anteriormente

         if (!$request->Machinesoptions)
         {
            $machinesOptions =  $request->Machinesoptions;
            $request->Machinesoptions;

            $machine_id = $request->machine_id;
            $machine_id = 0;


         if($Receivedimage){
             $path =  $request->file('image')->store('images','public');
             $input['image'] = $path;
             $img = Image::make('storage/'. $path);
             $img->resize(2, 2);
         }

         else{
             $path = "default.png";
         }


         $createProd = new Product();
         $createProd->name = $request->input('name');
         $createProd->SKU = $SKU;
         $createProd->category = $request->input('category');
         $createProd->brand = $brand;
         $createProd->image = $path;
         $createProd->Sell_Price = $request->input('Sell_Price');;
         $createProd->Sell_PriceVat =  $Sell_PriceVat;
         $createProd->Cost_Price = $request->input('Cost_Price');
         $createProd->quantity = $request->input('quantity');
         $createProd->about = $about;
         $createProd->condition = $condition;
         $createProd->supplier = $request->input('supplier');
         $createProd->isTheVatFree = $isTheVatFree;
         $updateProd = $createProd->save();


         $idNewProduct = $createProd->id;

         $vals = $request->Machinesoptions;

         $created_at = $createProd->created_at;
         $updated_at = $createProd->updated_at;


         $addtooutgoing = $request->outgoingcheck;

         if(isset($addtooutgoing)){
             // add na tabela de outgoing
             $Cost_Price = $request->input('Cost_Price');
             $quantity = $request->input('quantity');
             $totalCost  = $Cost_Price * $quantity;

             $outgoing = new outgoing();
             $outgoing->name = $request->input('name');
             $outgoing->code = $SKU;
             $outgoing->outgoingCategory = 3; // That's means Products
             $outgoing->brand = $brand;
             $outgoing->Cost_Price = $totalCost;
             $outgoing->quantity = $quantity;
             $outgoing->about = $about;
             $outgoing->condition = $condition;
             $addoutgoing = $outgoing->save();
         }


         if($updateProd)
         {

         return redirect()
                     ->route('product.reports.index')
                     ->with('success',  'The product was successful created' );
         }


         else
         {
             return redirect()
                         ->back()
                         ->with('error', $response['message']);
         }


     }

     else {


         $machinesOptions =  $request->Machinesoptions;
         $request->Machinesoptions;

         $machine_id = $request->machine_id;
         $machine_id = 0;


         //  return $vals;

         if($Receivedimage){
             $path =  $request->file('image')->store('images','public');
             $input['image'] = $path;
             $img = Image::make('storage/'. $path);
             $img->resize(2, 2);
         }

         else{
             $path = "default.png";
         }

         //  'name', 'SKU', 'category', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about'


          $createProd = new Product();
          $createProd->name = $request->input('name');
          $createProd->SKU = $SKU;
          $createProd->category = $request->input('category');
          $createProd->brand = $brand;
          $createProd->image = $path;
          $createProd->Sell_Price = $request->input('Sell_Price');
          $createProd->Sell_PriceVat = $request->input('Sell_PriceVat');
          $createProd->Cost_Price = $request->input('Cost_Price');
          $createProd->quantity = $request->input('quantity');
          $createProd->about = $about;
          $createProd->condition = $condition;
          $updateProd = $createProd->save();

          if(isset($addtooutgoing)){
             // add na tabela de outgoing
             $Cost_Price = $request->input('Cost_Price');
             $quantity = $request->input('quantity');
             $totalCost  = $Cost_Price * $quantity;

             $outgoing = new outgoing();
             $outgoing->name = $request->input('name');
             $outgoing->code = $SKU;
             $outgoing->outgoingCategory = 3; // That's means Products
             $outgoing->brand = $brand;
             $outgoing->Cost_Price = $totalCost;
             $outgoing->quantity = $quantity;
             $outgoing->about = $about;
             $outgoing->condition = $condition;
             $addoutgoing = $outgoing->save();
         }



          if($updateProd)
                 return redirect()
                         ->route('product.reports.index')
                         ->with('success',  'The product was successfull created!' );

             else
                 return "Something get wrong";


                 if($response['success'])
                     return redirect()
                                 ->route('product.reports.index')
                                 ->with('success', $response['message']);

                 return redirect()
                             ->back()
                             ->with('error', $response['message']);
     }
 }


    public function edit($id, $from = null)
    {

        $backRoute = $from;

        $allproducts = productsAllinfos::find($id);
        $allcategories = Category::all();
        $allSuppliers = supplier::all();



        // como sao as maquinas internas entao é o internalmachines
        $allmachines = internalmachines::all();


        $img = $allproducts->image;
        $categoryId = $allproducts->category;
        $categoryName = $allproducts->categoryName;


        $allproductsfindVAT = product::find($id);
        $Sell_PriceVat = $allproductsfindVAT->Sell_PriceVat;
        $prodCondition = $allproductsfindVAT->condition;

        // this actual category
        $thiscategoryid = $allproductsfindVAT->category;
        $allcategories2 = Category::find($thiscategoryid);
        $thiscategoryName = $allcategories2->name;

        // this actual supplier
        $thisSupplierId = $allproductsfindVAT->supplier;

        $thisSupplierInfos = supplier::find($thisSupplierId);

        if($thisSupplierInfos == []){
            $existingUser = false;
            $supplierFoundName = "Deleted Supplier";
            $supplierFoundId = "Deleted Supplier";
        }
        else{
            $existingUser = true;
            $supplierFoundName = $thisSupplierInfos->name;
            $supplierFoundId = $thisSupplierInfos->id;
        }




        $machinesByProducts = ShowMachinesByProducts::where('ProductId', 'LIKE', $id)->get();

        $MoreInfos = ShowMachinesByProducts::where('ProductId', 'LIKE', $id)->first();


        //find machine selected in this product
        $findMachines = products_machines::where('product_id', 'LIKE', $id)->get();

        // $opcoesMarcadas = [];
        $opcoesMarcadas = array();
        $todasMaquinas = array();

        // foreach nas maquinas

        // foreach ($allmachines as $key => $fm)
        // {
        //     $model = $fm->model;
        // }


        $lista = DB::table('internalmachines')->get();

        foreach($findMachines as $item){
               $opcoesMarcadas[] =  $item->machine_id;
        }

        foreach($lista as $item){
               $todasMaquinas[] =  $item->id;
        }



          $outrasop = productsmachinesallinfos::where('product_id', 'LIKE', $id)->get();
          $outrasoparray = array();

          foreach($outrasop as $item){
              // pega o machine id dentro dessa variavel q ja esta puxando  da tabela
            $outrasoparray[] =  $item->machine_id;
     }




        $type1 = gettype($todasMaquinas);
        $type2 = gettype($outrasoparray);
        $uniao =  ($todasMaquinas +  $outrasoparray);
        $max = sizeof($uniao);

        // array com as respostas diferentes entre ambos outros arrays
        $array3 = array();
        foreach($todasMaquinas as $maquinas){
            // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
            if(!in_array($maquinas, $outrasoparray)){
                $array3[] =  $maquinas;
            }
        }


        $max2 = sizeof($array3);
        if($max2 != 0)
        {
            for($i =0; $i < $max2; $i++){
                // return $uniao[$i];
                $allmachines2 = internalmachines::find($array3[$i]);
                $respostaMachines[] =  $allmachines2;
                $statusNulo = false;
            }
        }
        else{
            $respostaMachines =0;
            $statusNulo = true;
        }



        return view('sections.products.edit', compact('allSuppliers', 'outrasop','allproducts', 'supplierFoundName', 'supplierFoundId',
        'machinesByProducts', 'existingUser', 'img', 'categoryId', 'allcategories','allmachines', 'categoryName', 'Sell_PriceVat', 'findMachines', 'opcoesMarcadas', 'respostaMachines', 'statusNulo', 'thiscategoryid', 'thiscategoryName', 'from', 'backRoute', 'prodCondition', ));
    }


    public function takingdatas(){
         $allmachines = Machine::all();
         $allproducts = Machine::all();
         $a=1;
        return response(json_encode($allmachines,$a), 200) ;


    }



    public function view($id, $from = null)
    {

       $allproducts = productsAllinfos::find($id);

        if($allproducts == null){
                return redirect()
                ->back()
                ->with('error', 'Was not possible find this product it may has been deleted');
        }

       $img = $allproducts->image;

       $machinesByProducts = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->get();

       $MoreInfos = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->first();

       $allsales = productSales::where('ProductId', $id)->get();




       return view('sections.products.view', compact('allsales', 'allproducts','machinesByProducts', 'img', 'from'));
    }


    public function forcustomersview($id)
    {

       $allproducts = productsAllinfos::find($id);

       $img = $allproducts->image;

       $machinesByProducts = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->get();

       $MoreInfos = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->first();

       return view('sections.products.forcustomersview', compact('allproducts','machinesByProducts', 'img'));
    }

    public function destroy($id)
    {
        $deleteproducts = Product::find($id)->delete();
        // $deleteproducts2 = products_machines::where('product_id', 'LIKE', $id)->delete();
        {$deleteproducts = products_machines::where('product_id', 'LIKE', $id)->delete();}



        if($deleteproducts){
            return redirect()
                    ->route('product.reports.index')
                    ->with('success',  'The product was successful removed' );
            }


            else
            {
                $response='';
                return redirect()
                            ->back()
                            ->with('error');
             }

    }



    public function getProdsAjax(Request $request)
    {
        $dataId = $request->data;
        foreach ($dataId as $key => $datObj){
            $vals = $request->Machinesoptions;
            $prodsFound =  $prod = Product::find($dataId);
            // $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $ProductId, $created_at, $updated_at]);
        }
        return $prodsFound;


    }

    public function getProdsAjax2(Request $request)
    {
         $produtosaocarregar = $request["valoresselecionados"][0];
         $valoresselecionados =  $request["valoresselecionados"][0];

        //     // todos os produtos referenciados à essa work order
        //     foreach($produtosaocarregar as $item){
        //     $prodStartUp[] =  $request->data[0];
        // }

        //     // todos os produtos referenciados à essa work order
        //     foreach($valoresselecionados as $item){
        //     $valoresSelected[] =  $request->valoresselecionados[0];
        // }


        $array3 = array();
        foreach($valoresselecionados as $prods){
            // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
            if(!in_array($prods, $produtosaocarregar)){
                $array3[] =  $prods;
            }
        }

        // retornando a diferença (interseccao)

        return $array3;


        $dataId = $request->data;
        foreach ($dataId as $key => $datObj){
            $vals = $request->Machinesoptions;
            $prodsFound =  $prod = Product::find($dataId);
            // $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $ProductId, $created_at, $updated_at]);
        }
        return $prodsFound;


    }



    public function update(ProductEditFormRequest $request, $id)
    {


        $prod = Product::find($id);
        $prod->image;

        if(isset($request->Sell_PriceVat))
        {
            $isTheVatFree = "no"; //no
            $Sell_PriceVat  = $request->input('Sell_PriceVat');
        }
        else{
             $isTheVatFree = "yes"; //yes
             $Sell_PriceVat  = $request->input('Sell_Price');
        }


      if ($path = $request->file('image')== null)
           $path = $prod->image;

      else
        $path = $request->file('image')->store('images','public') ;

        // 'name', 'SKU', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about'

        $product = product::find($id);
            if(isset($product)){
            $prod->name = $request->input('name');
            $prod->SKU = $request->input('SKU');
            $prod->category = $request->input('category');
            $prod->brand = $request->input('brand');
            $prod->image = $path;
            $prod->Sell_Price = $request->input('Sell_Price');
            $prod->Sell_PriceVat = $Sell_PriceVat;
            $prod->isTheVatFree = $isTheVatFree;
            $prod->Cost_Price = $request->input('Cost_Price');
            $prod->quantity = $request->input('quantity');
            $prod->about = $request->input('about');
            $prod->condition = $request->input('condition');
            $prod->supplier = $request->input('supplier');
            $updateProd = $prod->save();

            if($updateProd){

                //atualizando tabela de relação
                $Machinesoptions =  $request->Machinesoptions;
                $ProductId = $prod->id;
                $created_at = $prod->created_at;
                $updated_at = $prod->updated_at;

                //puxando os produtos existentes na tabela de relação
                 $findDatasonRelationTable = products_machines::where('product_id', 'LIKE', $id)->first();

                if(!isset($Machinesoptions)){
                    // return 1;
                    //se nenhum producto for selecionada, seja removida ou nao
                    if($findDatasonRelationTable){$deleteproducts = products_machines::where('product_id', 'LIKE', $id)->delete();}

                    return redirect()
                        ->route('product.reports.index')
                        ->with('success',  'The product was successfull updated!' );
                }


                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // create
                    // return 2;
                    foreach ($Machinesoptions as $key => $machObj){
                    $vals = $request->Machinesoptions;
                    $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $ProductId, $created_at, $updated_at]);
                    }
                }

                else{
                    //update  ->delete and create
                    // return 3;
                    $deleteproducts = products_machines::where('product_id', 'LIKE', $id)->delete();

                    if($deleteproducts){
                        foreach ($Machinesoptions as $key => $machObj){
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $ProductId, $created_at, $updated_at]);
                        }
                    }
                }


                return redirect()
                ->route('product.reports.index')
                ->with('success',  'The product was successfull edited!' );
            }



        else
            return "Something get wrong";


            if($response['success'])
                return redirect()
                            ->route('product.reports.index')
                            ->with('success',  'The product was successfull edited!' );

            return redirect()
                        ->back()
                        ->with('error', $response['message']);
        }

    }

    public function buyingProducts()
    {
        $allproducts = Product::all();
        return view('sections.products.buyingProducts', compact('allproducts'));
    }

    public function trolley(Request $request)
    {
        return $request;
    }

    public function buyingProductsPost(Request $request)
    {

        $results =  $request->except('_token');
        return $results;

        for( $i=0; $i<2; $i++){
            $imageSrc = $results['imageSrc'][$i];
            $title = $results['title'][$i];
            $price = $results['price'][$i];
            $qtdInStock = $results['qtdInStock'][$i];
            $productID = $results['productID'][$i];
            $col=  collect(['image'=>$imageSrc, 'title' => $title, 'price' => $price,
                            'qtdInStock' => $qtdInStock,
                            'productID' => $productID
                            ]);
        }

        return $col;

        return view('sections.products.invoiceBuying', compact('col'));
    }

    public function ajaxCart(Request $request)
    {
        $productsSearch = $request->all();
        return json_encode($productsSearch);
        // return redirect()->route('customer.index');

    }


    public function finishPayment(Request $request)
    {
        return $request->all();
        return redirect()->route('customer.index');

    }

    public function confirmPayment(Request $request)
    {
        // // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
        // $Machine_Id =  $request->machine;

        // $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
        // $machine_name = ($machine_info->model);


        // $ProductsInfo = ShowProductsByMachines::whereRaw('id_machine = ' . $Machine_Id)->get();


        // $typeofpayment =  $request->typeofpayment;
        // $nameCustomer =  $request->customer;
        // $dataConfirmPay = $request;
        // $product = $dataConfirmPay->title;

        $datas=  $request->productID;
        $Products = Product::find($datas);

        return view('sections.products.paymentsConfirmed', compact('Products'));

    }

    public function ajaxdr ($id)
    {


        // $data = json_decode($id);
        $data = json_decode($id);


            for ($i = 0; $i < sizeof($data); $i++) {
            $row = $data[$i];
            $dadosAgrupados =[
              $title =  $row->title,
              $price = $row->price,
              $productID = $row->productID,
              $qtd = 3
        ];

        }


        // echo $productID;
        // Ja temos o ID do produto
        /** TAREFAS: ACHAR PRODUTO, VER A QUANTIDADE E SUBSTITUIR E CADASTRAR NA TABELA DE VENDAS QUE VAMOS CRIAR */

        $achadoProduct = $findProduct = Product::find($productID);
        $name = $achadoProduct->name;
        $SKU = $achadoProduct->SKU;
        $category = $achadoProduct->category;
        $brand = $achadoProduct->brand;
        $image = $achadoProduct->image;
        $Sell_Price = $achadoProduct->Sell_Price;
        $Cost_Price = $achadoProduct->Cost_Price;
        $quantity = $achadoProduct->quantity;
        $about = $achadoProduct->about;
        $machines = $achadoProduct->machines;


        if($achadoProduct){
            $createProd = new Product();
            $createProd->name = $name;
            $createProd->SKU = $SKU;
            $createProd->category = $category;
            $createProd->brand = $brand;
            $createProd->image = $image;
            $createProd->Sell_Price = $Sell_Price;
            $createProd->Cost_Price = $Cost_Price;
            $createProd->quantity =  ($quantity - 3);
            $createProd->about = $about;
            $createProd->machines = $machines;
            $updateProd = $createProd->save();




         if($updateProd)
         {
                // quando o produto atualizar na tabela Prod, iremos criar um valor na tabela sales
                $createSales = new sales();
                $createSales->name = $name;
                $createSales->SKU = $SKU;
                $createSales->category =  $category;
                $createSales->brand = $brand;
                $createSales->image = $image;
                $createSales->Sell_Price = $Sell_Price;
                $createSales->Cost_Price = $Cost_Price;
                $createSales->quantity = $createProd->quantity;
                $createSales->about = $about;
                $createSales->machines = $machines;
                $createSales->sales_price =  $price;
                $createSales->sales_discount =  0;
                $createSales->sales_vat =  ($price * 0.20);
                $storeSales = $createSales->save();

                if($storeSales)
                {
                    return json_encode($dataArray);
                }
                else{
                    return "no created";
                }

        }

        else
            return "não atualizou";

        }
        else{
            return "0";
        }



        return view('sections.products.buy.ajaxdr', compact('id'));
    }



    public function getProductsAjaxOnReportsPage(Request $request)
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

        else if($orderByInput == "categoryName"){
            $orderByInputQuerry = "categoryName";
        }

        if($orderByInput == "orderByAll"){
            $allproducts = productsAllinfos::where('name', 'LIKE', "%$searchInput%")
            ->orWhere('id','LIKE', "%$searchInput%")
            ->orWhere('SKU','LIKE', "%$searchInput%")
            ->orWhere('brand','LIKE', "%$searchInput%")
            ->orWhere('about','LIKE', "%$searchInput%")
            ->orWhere('categoryName','LIKE', "%$searchInput%")
            ->get();
            return $allproducts;
        }
        else{
            $allproducts = productsAllinfos::where('name', 'LIKE', "%$searchInput%")
            ->orWhere('SKU','LIKE', "%$searchInput%")
            ->orWhere('id','LIKE', "%$searchInput%")
            ->orWhere('brand','LIKE', "%$searchInput%")
            ->orWhere('about','LIKE', "%$searchInput%")
            ->orWhere('categoryName','LIKE', "%$searchInput%")
            ->OrderByRaw($orderByInputQuerry . ' '. $ascOrDesc)
            ->get();
            return $allproducts;
        }
    }


    public function export()
    {
        return Excel::download(new ProductsExport, 'productsexport.xlsx');
    }

}
