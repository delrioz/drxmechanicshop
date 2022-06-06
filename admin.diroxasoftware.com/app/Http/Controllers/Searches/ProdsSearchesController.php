<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
USE App\ShowMachinesByProducts;
use App\Machine;
use App\internalmachines;
use App\productsAllinfos;
use App\accessinternalmachinesbyproducts;
use App\productSales;

class ProdsSearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productsSearch = Product::paginate(1000);
        return view ('sections.searches.products.index', compact('productsSearch'));
    }
    public function edit($id)
    {   
        $allproducts = productsAllinfos::find($id);
        $img = $allproducts->image;
        $machinesByProducts = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->get();
        $MoreInfos = accessinternalmachinesbyproducts::where('ProductId', 'LIKE', $id)->first();
        $allsales = productSales::where('ProductId', $id)->get();


        return view('sections.searches.products.edit', compact('allproducts','machinesByProducts', 'img', 'allsales'));
    }

    public function search(Request $request)
    {   
        
        // return json_encode($request->searchOption);
        
        //taking the informations from the request
        $dataForm = $request->except('_token');
        $nameText = $request->nameText;
        $searchOption = $request->searchOption;

        if($nameText == "" && $searchOption == ""){
                $nameText = 0 ;
                $searchOption = 0;
                return view('sections.searches.index', compact('nameText','searchOption', 'dataForm'));
        }
        else{
            // Will check which database we'll search in 
            
            if(($dataForm['searchOption'] == "machines")){
                $machinesSearch =  internalmachines::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  
                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $machinesSearch = $query->where('model', 'LIKE', "%{$nameText}%");      
              })->paginate(5500);
              return json_encode($machinesSearch);
            }  
            
            if(($dataForm['searchOption'] == "products")){
                $productsSearch =  Product::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  

                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");      
              })->paginate(5500);
              return json_encode($productsSearch);
            }  


            if(($dataForm['searchOption'] == "categories")){
                $productsSearch =  productsallinfos::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  

                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $productsSearch = $query->where('categoryName', 'LIKE', "%{$nameText}%");      
              })->paginate(5500);
              return json_encode($productsSearch);
            }  


            if(($dataForm['searchOption'] == "general")){
                $nameText = 0 ;
                $searchOption = 0;
                return view('sections.searches.index', compact('nameText','searchOption'));
            }  


            // if(isset($dataForm['searchOption']))
            // $musicaspost = $query->where('searchOption', 'LIKE', "%{$categoria}%");

        }
    }
}
