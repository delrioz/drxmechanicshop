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
use App\productsAllinfos;
use App\accessinternalmachinesbyproducts;
use App\products_machines;
use App\productsmachinesallinfos;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $allproducts = productsAllinfos::all();
        return view('sections.products.index', compact('allproducts'));
    }


    public function create()
    {

        $allproducts = Product::all();
        $allcategories = Category::all();
        $allmachines = internalmachines::all();

        return view('sections.products.create', compact('allproducts', 'allcategories', 'allmachines'));

    }

    public function edit($id)
    {
        $allproducts = productsAllinfos::find($id);
        $allcategories = Category::all();

        // como sao as maquinas internas entao é o internalmachines
        $allmachines = internalmachines::all();
    

        $img = $allproducts->image;
        $categoryId = $allproducts->category;
        $categoryName = $allproducts->categoryName;


         $allproductsfindVAT = product::find($id);
         $Sell_PriceVat = $allproductsfindVAT->Sell_PriceVat;


        $machinesByProducts = ShowMachinesByProducts::where('ProductId', 'LIKE', "%{$id}%")->get();

        $MoreInfos = ShowMachinesByProducts::where('ProductId', 'LIKE', "%{$id}%")->first(); 


        //find machine selected in this product
        $findMachines = products_machines::where('product_id', 'LIKE', "%{$id}%")->get(); 

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
        
            
        return view('sections.products.edit', compact('outrasop','allproducts','machinesByProducts', 'img', 'categoryId', 'allcategories','allmachines', 'categoryName', 'Sell_PriceVat', 'findMachines', 'opcoesMarcadas', 'respostaMachines', 'statusNulo'));
    }

    
    public function takingdatas(){
         $allmachines = Machine::all();
         $allproducts = Machine::all();
         $a=1;
        return response(json_encode($allmachines,$a), 200) ;


    }

    public function store(Request $request)
    {
        
        if (!$request->Machinesoptions)
        {

        $machinesOptions =  $request->Machinesoptions;
        $request->Machinesoptions;

        $machine_id = $request->machine_id;
        $machine_id = 0;



        //  return $vals;

        //  NAO CADASTRAR AQUI, MAS SIM NA TABELA DE RELAÇÃO !!!!!!!!!!!!!!!!!!!!!!!!!!!!

         $path =  $request->file('image')->store('images','public');
         $input['image'] = $path;
         $img = Image::make('storage/'. $path);
         $img->resize(2, 2);

        //  'name', 'SKU', 'category', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about'


         $createProd = new Product();
         $createProd->name = $request->input('name');
         $createProd->SKU = $request->input('SKU');
         $createProd->category = $request->input('category');
         $createProd->brand = $request->input('brand');
         $createProd->image = $path;
         $createProd->Sell_Price = $request->input('Sell_Price');
         $createProd->Sell_PriceVat = $request->input('Sell_PriceVat');
         $createProd->Cost_Price = $request->input('Cost_Price');
         $createProd->quantity = $request->input('quantity');
         $createProd->about = $request->input('about');
         $createProd->machines = $machine_id;
         $updateProd = $createProd->save();


        $idNewProduct = $createProd->id;

        $vals = $request->Machinesoptions;

        $created_at = $createProd->created_at;
        $updated_at = $createProd->updated_at;


         if($updateProd)
         {
           
         return redirect()
                     ->route('product.index')
                     ->with('success',  'The customer was successful update' );
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

        //  NAO CADASTRAR AQUI, MAS SIM NA TABELA DE RELAÇÃO !!!!!!!!!!!!!!!!!!!!!!!!!!!!

         $path =  $request->file('image')->store('images','public');
         $input['image'] = $path;
         $img = Image::make('storage/'. $path);
         $img->resize(2, 2);

        //  'name', 'SKU', 'category', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about'


         $createProd = new Product();
         $createProd->name = $request->input('name');
         $createProd->SKU = $request->input('SKU');
         $createProd->category = $request->input('category');
         $createProd->brand = $request->input('brand');
         $createProd->image = $path;
         $createProd->Sell_Price = $request->input('Sell_Price');
         $createProd->Sell_PriceVat = $request->input('Sell_PriceVat');
         $createProd->Cost_Price = $request->input('Cost_Price');
         $createProd->quantity = $request->input('quantity');
         $createProd->about = $request->input('about');
         $createProd->machines = $machine_id;
         $updateProd = $createProd->save();


        $idNewProduct = $createProd->id;

        $vals = $request->Machinesoptions;

        $created_at = $createProd->created_at;
        $updated_at = $createProd->updated_at;

         foreach ($machinesOptions as $key => $machObj)
         {
         $vals = $request->Machinesoptions ;

     


        //  INSERT INTO products_machines set machine_id = 44, product_id = '55;
        //  $product_machine_inster = ( DB::select("INSERT INTO  products_machines SET products_machines =', $machObj,'machine_id =', $idNewProduct"));
        $product_machine_inster = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $idNewProduct, $created_at, $updated_at]);



        //  $updateProd = $createProd_Machine->save();

        }



         if($updateProd)
                return redirect()
                        ->route('product.index')
                        ->with('success',  'The product was successfull created!' );

            else
                return "Something get wrong";


                if($response['success'])
                    return redirect()
                                ->route('product.index')
                                ->with('success', $response['message']);

                return redirect()
                            ->back()
                            ->with('error', $response['message']);
    }
}


    public function view($id)
    {
       $allproducts = productsAllinfos::find($id);

       $img = $allproducts->image;

       $machinesByProducts = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "%{$id}%")->get();

       $MoreInfos = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "%{$id}%")->first();

       return view('sections.products.view', compact('allproducts','machinesByProducts', 'img'));
    }

    public function destroy($id)
    {
        $deleteproducts = Product::find($id)->delete();

        if($deleteproducts){
            return redirect()
                        ->route('product.index')
                        ->with('success',  'The product was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }






    public function update(Request $request, $id)
    { 
        
        $prod = Product::find($id);
        $prod->image;


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
            $prod->Sell_PriceVat = $request->input('Sell_PriceVat');
            $prod->Cost_Price = $request->input('Cost_Price');
            $prod->quantity = $request->input('quantity');
            $prod->about = $request->input('about');
            $updateProd = $prod->save();

            if($updateProd)
        {
            
            $machinesOptions =  $request->Machinesoptions;

            $productId = $prod->id;
            $created_at = $prod->created_at;
            $updated_at = $prod->updated_at;


             $findDatasonRelationTable = products_machines::where('product_id', 'LIKE', "%{$id}%")->first();

            if(!isset($machinesOptions)){
                //se nenhuma maquina for selecionada, seja removida ou nao 
                if($findDatasonRelationTable){$deleteproducts = products_machines::where('product_id', 'LIKE', "%{$id}%")->delete();}
                
                return redirect()
                    ->route('product.index')
                    ->with('success',  'The product was successfull created!' );
            }
            

            if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                // create
                foreach ($machinesOptions as $key => $machObj){  
                $vals = $request->Machinesoptions;
                $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $productId, $created_at, $updated_at]);
                }
            }

            else{

                //update  ->delete and create 
                $deleteproducts = products_machines::where('product_id', 'LIKE', "%{$id}%")->delete();
                if($deleteproducts){
                    foreach ($machinesOptions as $key => $machObj){  
                        $vals = $request->Machinesoptions;
                        $product_machine = DB::insert('insert into products_machines (machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?)', [$machObj, $productId, $created_at, $updated_at]);
                    }
                }
            }
 
            return redirect()
                    ->route('product.index')
                    ->with('success',  'The product was successfull created!' );
        }
        
        else
            return "Something get wrong";


            if($response['success'])
                return redirect()
                            ->route('product.index')
                            ->with('success', $response['message']);

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

}
