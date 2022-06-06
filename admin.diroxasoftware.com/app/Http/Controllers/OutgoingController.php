<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\outgoing;
use App\outgoingcategory;
use App\alloutgoinginformations;
use App\supplier;
use DB;
use Image;

class OutgoingController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

        public function index()
        {
            $alloutgoing = alloutgoinginformations::all();

            $nTotalOutgoing = outgoing::select(DB::raw('COUNT(*) AS total'))
            ->first();
            $nTotalOutgoing = $nTotalOutgoing-> total;

            $amountExpenses = outgoing::select(DB::raw('SUM(Cost_Price) AS total'))
            ->first();
            $amountExpenses = $amountExpenses-> total;


            $amountExpenses = number_format($amountExpenses, 2, '.',',');

            return view('sections.outgoing.index', compact('alloutgoing','nTotalOutgoing','amountExpenses'));
        }

        public function create()
        {
            $allSuppliers = supplier::all();
            $outgoingcategory = outgoingcategory::all();
            return view('sections.outgoing.create', compact('outgoingcategory', 'allSuppliers'));
        }


        public function store(Request $request)
        {
            $invoiceFile = $request->invoiceFile;

            try{
            if($invoiceFile){ // se receberam o comprovante de id
                $pathinvoiceFile =  $request->file('invoiceFile')->store('images','public');
                $input['invoiceFile'] = $pathinvoiceFile;
                $img = Image::make('storage/'. $pathinvoiceFile);
                $img->resize(2, 2);
            }   
            }
            catch(Exception $e){
                return 1;
                return $e." Something get wrong";
            }



        $request->name == null ? $name =  'Outgoing Title' : $name = $request->name;
        $request->code == null ? $code =  'Outgoing Code' : $code = $request->code;
        $request->brand == null ? $brand =  'Outgoing Brand' : $brand = $request->brand;
        $request->about == null ? $about =  'nothing to add' : $about = $request->about;
        $request->quantity == null ? $quantity =  0 : $quantity = $request->quantity;
        $request->invoiceFile == null ? $pathinvoiceFile =  "default.png" : $pathinvoiceFile = $pathinvoiceFile;

            $addoutgoing = new outgoing();
            $addoutgoing->name = $name;
            $addoutgoing->code = $code;
            $addoutgoing->outgoingCategory = $request->category;
            $addoutgoing->brand = $brand;
            $addoutgoing->Cost_Price = $request->Cost_Price;
            $addoutgoing->quantity = $quantity;
            $addoutgoing->about = $about;
            $addoutgoing->condition = $request->condition;
            $addoutgoing->invoiceFile = $pathinvoiceFile;
            $addedoutgoing = $addoutgoing->save();

            if($addedoutgoing)
            {

                return redirect()
                ->route('outgoing.index')
                ->with('success',  'The Outgoing was successful added!' );
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
            $alloutgoing = alloutgoinginformations::where('outgoingId', 'LIKE', $id)->get()[0];
            $outgoingcategory = outgoingcategory::all();
            // this actual category
            $thiscategoryid = $alloutgoing->outgoingCategory;
            $thiscategoryName = $alloutgoing->outgoingCategoryName;

            return view('sections.outgoing.edit', compact('alloutgoing', 'outgoingcategory', 'thiscategoryName', 'thiscategoryid'));
        }

        public function update(Request $request)
        {
            $request->name == null ? $name =  'Outgoing Title' : $name = $request->name;
            $request->code == null ? $code =  'Outgoing Code' : $code = $request->code;
            $request->brand == null ? $brand =  'Outgoing Brand' : $brand = $request->brand;
            $request->about == null ? $about =  'nothing to add' : $about = $request->about;
            $request->quantity == null ? $quantity =  0 : $quantity = $request->quantity;

            $outgoing = outgoing::find($request->outgoingId);
            if(isset($outgoing)){

            $outgoing->name = $name;
            $outgoing->code = $code;
            $outgoing->outgoingCategory = $request->category;
            $outgoing->brand = $brand;
            $outgoing->Cost_Price = $request->Cost_Price;
            $outgoing->quantity = $quantity;
            $outgoing->about = $about;
            $outgoing->condition = $request->condition;
            $updateoutGoing = $outgoing->save();

            if($updateoutGoing){
                return redirect()
                ->route('outgoing.index')
                ->with('success',  'The Outgoing was successfull edited!' );
            }

            else
                    return redirect()
                    ->back();
            }
    }


    public function view($id)
    {
        $alloutgoing = alloutgoinginformations::where('outgoingId', 'LIKE', $id)->get()[0];
        $outgoingcategory = outgoingcategory::all();
        // this actual category
        $thiscategoryid = $alloutgoing->outgoingCategory;
        $thiscategoryName = $alloutgoing->outgoingCategoryName;
        return view('sections.outgoing.view', compact('alloutgoing', 'outgoingcategory', 'thiscategoryName', 'thiscategoryid'));
    }

    public function destroy($id)
    {

        $deleteoutgoing = outgoing::find($id)->delete();
        // $deleteproducts2 = products_machines::where('product_id', 'LIKE', $id)->delete();
        // {$deleteproducts = products_machines::where('product_id', 'LIKE', $id)->delete();}



        if($deleteoutgoing){
            return redirect()
                    ->route('outgoing.index')
                    ->with('success',  'The Outgoing was successful removed' );
            }

            else
            {
                $response='';
                return redirect()
                            ->back()
                            ->with('error');
                }

    }

}
