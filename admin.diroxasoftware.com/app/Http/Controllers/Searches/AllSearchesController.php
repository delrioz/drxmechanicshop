<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Machine;
use App\internalmachines;
use App\Product;

class AllSearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('sections.searches.index');
    }


    
    public function indexwithoutajax(Request $request)
    {
        //taking the informations from the request
        $dataForm = $request->except('_token');
        $nameText = $request->nameText;
        $searchOption = $request->searchOption;

        if($nameText == "" && $searchOption == ""){
                $nameText = "" ;
                $searchOption = "";
                return view('sections.searches.index', compact('nameText','searchOption', 'dataForm'));
        }
        else{
            // Will check which database we'll search in 
            
            if(($dataForm['searchOption'] == "machines")){
                $machinesSearch =  internalmachines::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  

                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $machinesSearch = $query->where('model', 'LIKE', "%{$nameText}%");      
              })->paginate(100);
              return view('sections.searches.machines.index', compact('nameText','searchOption', 'machinesSearch', 'dataForm'));
            }  
            
            if(($dataForm['searchOption'] == "products")){
                $productsSearch =  Product::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  

                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");      
              })->paginate(100);
              return view('sections.searches.products.index', compact('nameText','searchOption', 'productsSearch', 'dataForm'));
            }  


            if(($dataForm['searchOption'] == "general")){
                $nameText = 0 ;
                $searchOption = 0;
                return view('sections.searches.index', compact('nameText','searchOption'));
            }  


            // if(isset($dataForm['searchOption']))
            // $musicaspost = $query->where('searchOption', 'LIKE', "%{$categoria}%");

        }

        return view ('sections.searches.index');
    }
}
