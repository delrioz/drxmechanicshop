<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\accessproductsbyinternalmachines;
use App\internalmachines;
use App\Product;
use App\machinesallinfos;

class ProductsInMachines extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    // to show the machines for we can click and see which products is inside it
    $allmachines = internalmachines::all();
    return view('sections.searches.ProductsInMachines.index', compact('allmachines'));
  }

  public function searchIndex($id)
  {

    // make de research receiving only the Id 

      $allmachinedatas = internalmachines::find($id);

      if($allmachinedatas)
      {
          $machineId = $allmachinedatas->id;
          // nome da maquina 
          $name = $allmachinedatas->model;

          // aqui achamos todos os produtos relacionados
          $allproducts = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', "{$machineId}")->get();
          return view('sections.searches.ProductsInMachines.searchpage', compact('allproducts', 'allmachinedatas', 'name'));
      }
      
      else{
          // aqui achamos todos os produtos relacionados
          $allproducts = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', "%{$nameMachine}%")->get();
          return view('sections.searches.ProductsInMachines.searchpage', compact('allproducts', 'allmachinedatas', 'name'));
      }
  }

  public function search(Request $request)
  {

    $name = $request->name;

    if($request->name == null || $request == null)
    {
      $allmachines = internalmachines::all();
      return view('sections.searches.ProductsInMachines.index', compact('allmachines'));
    }

     else{
           // PROUCURO A MAQUINA PARA SABER O PRODUTO
           // aui achamos a maquina que foi relacionada na pesquisa
              $nameMachine = $request->name;
              // pegando dados e id da maquina
              $allmachinedatas = internalmachines::where('model', 'LIKE', "%{$nameMachine}%")->first();

              if($allmachinedatas)
              {
                  $machineId = $allmachinedatas->id;
                  // aqui achamos todos os produtos relacionados
                  $allproducts = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', "{$machineId}")->get();
                  return view('sections.searches.ProductsInMachines.searchpage', compact('allproducts', 'allmachinedatas', 'name'));
              }
              
              else{
                  // aqui achamos todos os produtos relacionados
                  $allproducts = accessproductsbyinternalmachines::where('machineIdinMachine', 'LIKE', "%{$nameMachine}%")->get();
                  return view('sections.searches.ProductsInMachines.searchpage', compact('allproducts', 'allmachinedatas', 'name'));
              }
     }
  }
}
