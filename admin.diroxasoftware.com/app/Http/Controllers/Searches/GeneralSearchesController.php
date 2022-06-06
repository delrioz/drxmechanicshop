<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
USE App\ShowMachinesByProducts;
use App\Machine;
use App\internalmachines;
use App\productsAllinfos;

class GeneralSearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {


      $allmachines = internalmachines::all();
      $allproducts = productsallinfos::all();

      // return view('sections.searches.general.index', compact('nameText','searchOption', 'dataForm', 'allproducts', 'allmachines'));

        //taking the informations from the request
        $dataForm = $request->except('_token');
        $nameText = $request->nameText;
        $searchOption = $request->searchOption;

        if($nameText == "" && $searchOption == ""){
                $nameText = "" ;
                $searchOption = "";
                return view('sections.searches.general.index', compact('nameText','searchOption', 'dataForm','allmachines','allproducts'));
        }

        else{

              if(($dataForm['searchOption'] == "machines")){
                $machinesSearch =  internalmachines::where(function ($query) use
                ($dataForm, $nameText, $searchOption) {
                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $machinesSearch = $query->where('model', 'LIKE', "%{$nameText}%");
              })->paginate(1000);
              return view('sections.searches.machines.index', compact('nameText','searchOption', 'machinesSearch', 'dataForm'));            }

            if(($dataForm['searchOption'] == "products")){
              $productsSearch =  Product::where(function ($query) use
              ($dataForm, $nameText, $searchOption) {
              if(isset($dataForm['nameText']))
              $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");
              })->paginate(1000);
              return view('sections.searches.products.index', compact('nameText','searchOption', 'productsSearch', 'dataForm'));
          }


          if(($dataForm['searchOption'] == "general")){
            $allmachines = internalmachines::where(function ($query) use
            ($dataForm, $nameText, $searchOption) {
              if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $machinesSearch = $query->where('model', 'LIKE', "%{$nameText}%");
              })->paginate(1000);

            $allproducts = Product::where(function ($query) use
            ($dataForm, $nameText, $searchOption) {
              if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");
              })->paginate(1000);
          }

        return view('sections.searches.general.index', compact('nameText','searchOption', 'allproducts', 'allmachines', 'dataForm'));
    }
  }
}
