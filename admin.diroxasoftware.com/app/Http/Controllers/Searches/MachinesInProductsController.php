<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\accessinternalmachinesbyproducts;
use App\Product;
use App\productsAllinfos;

class MachinesInProductsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      // products to show in the index page
      $allproducts = productsAllinfos::all();
      return view('sections.searches.machinesInProducts.index', compact('allproducts'));
  }

  public function searchIndex($id)
  {

        // procuro sabendo apenas o Id
        $allproductsdatas = Product::find($id);

    
      if($allproductsdatas)
      {
          $productId = $allproductsdatas->id;
          $name = $allproductsdatas->name;
          // aqui achamos todos os produtos relacionados
          $allmachines = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "{$productId}")->get();
          return view('sections.searches.machinesInProducts.searchpage', compact('allmachines', 'allproductsdatas', 'name'));
      }
      
      else{
         $name = $allproductsdatas->name;
          // aqui achamos todos os produtos relacionados
          $allmachines = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "%{$name}%")->get();
          return view('sections.searches.machinesInProducts.searchpage', compact('allmachines', 'allproductsdatas', 'name'));
      }
           
  }

  public function search(Request $request)
  {

    
    $name = $request->name;

    if($request->name == null)
    {
      // se digitou nada
      $allproducts = productsAllinfos::all();
      return view('sections.searches.machinesInProducts.index', compact('allproducts'));
    }

    else{

            $name = $request->name;
            // PROUCURO O PRODUTO PARA SABER A MAQUINA
            // aqui achamos o produto que foi relacionada na pesquisa
              $allproductsdatas = Product::where('name', 'LIKE', "%{$name}%")->first();


            // aqui achamos todos as maquinas relacionadas relacionados
            // return  $allmachines = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "%{$idProduto}%")->get();
           
          
           if($allproductsdatas)
           {
               $productId = $allproductsdatas->id;
               // aqui achamos todos os produtos relacionados
                $allmachines = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "{$productId}")->get();
               return view('sections.searches.machinesInProducts.searchpage', compact('allmachines', 'allproductsdatas', 'name'));
              //  return view('sections.searches.machinesInProducts.searchpage', compact('allmachines', 'allproductsdatas', 'name'));
           }
           
           else{
               // aqui achamos todos os produtos relacionados
               $allmachines = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', "%{$name}%")->get();
               return view('sections.searches.machinesInProducts.searchpage', compact('allmachines', 'allproductsdatas', 'name'));
           }
           
    }
  }
}
