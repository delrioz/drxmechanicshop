<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productsAllinfos;
use App\accessinternalmachinesbyproducts;
use App\tablesprices;


class TablePricesController extends Controller
{
    public function index()
    {
       $id = 12;

       $alltableprices = tablesprices::all();

       $from = "rwrewew";

        return view('sections.tableprices.index', compact('alltableprices', 'from'));
    }

    public function create()
    {
        return view('sections.tableprices.create');
    }

    public function store(Request $request)
    {
          $createTablePrices = new tablesprices();
          $createTablePrices->name = $request->input('name');
          $createTablePrices->about = $request->input('about');
          $createTablePrices->Sell_Price = $request->input('Sell_Price');;
          $createTablePrices->Sell_PriceVat = $request->input('Sell_PriceVat');
          $savePrices = $createTablePrices->save();


          if($savePrices)
          {

          return redirect()
                      ->route('tableprices.index')
                      ->with('success',  'The Table Price was successful added' );
          }


          else
          {
              return redirect()
                          ->back()
                          ->with('error', $response['message']);
           }
    }


    public function edit($id)
    {
        $findtableprices = tablesprices::find($id);
        return view('sections.tableprices.edit', compact('findtableprices'));
    }


    public function update(Request $request)
    {
        $tablepricesid = $request->tablepricesid;
        $name =  $request->name;
        $tableprices = tablesprices::find($tablepricesid);
        $tableprices->name = $name;
        $tableprices->about = $request->input('about');
        $tableprices->sell_price = $request->input('sell_Price');;
        $tableprices->sell_priceVat = $request->input('sell_priceVat');
        $updatetableprices = $tableprices->save();

        if(($updatetableprices)){
            return redirect()
                ->route('tableprices.index')
                ->with('success',  'The Table Price was successfull updated!' );
              }
        }
}
