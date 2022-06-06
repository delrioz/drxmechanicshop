<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\supplier;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $allSuppliers = supplier::all();
        return view('sections.supplier.index', compact('allSuppliers'));
    }

    public function create()
    {
        $backRoute = "supplierIndex";
        return view('sections.supplier.create', compact('backRoute'));
    }

    public function store(Request $request)
    {
        $request->brand == null ? $brand =  'Product brand' : $brand = $request->brand;
        $request->contactNumber == null ? $contactNumber =  'no number' : $contactNumber = $request->contactNumber;
        $request->contactEmail == null ? $contactEmail =  'no email' : $contactEmail = $request->contactEmail;
        $request->location == null ? $location =  'no location' : $location = $request->location;
        $request->note == null ? $note =  'no note' : $note = $request->note;

        $addSupplier = new supplier();
        $addSupplier->name = $request->input('name');
        $addSupplier->location = $location;
        $addSupplier->contactNumber = $contactNumber;
        $addSupplier->contactEmail = $contactEmail;
        $addSupplier->note = $note;
        $updateSupplier = $addSupplier->save();

        if($updateSupplier)
        {

        return redirect()
                    ->route('supplier.index')
                    ->with('success',  'The Supplier was successful added' );
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
        $findSupplier = supplier::find($id);
        $backRoute = "supplierIndex";
        return view('sections.supplier.edit', compact('findSupplier', 'backRoute'));
    }

    public function update(Request $request)
    {        
        $supplierId =  $request->supplierId;
        $supp = supplier::find($supplierId);
        $supp->name = $request->input('name');
        $supp->contactNumber = $request->input('contactNumber');
        $supp->contactEmail = $request->input('contactEmail');
        $supp->location = $request->input('location');
        $supp->note = $request->input('note');
        $updatesupp = $supp->save();
        
        if($updatesupp)
        {

        return redirect()
                    ->route('supplier.index')
                    ->with('success',  'The Supplier was successful updated');
        }


        else
        {
            return redirect()
                        ->back()
                        ->with('error', $response['message']);
        }

    }


    public function view($id)
    {
        $findSupplier = supplier::find($id);
        $backRoute = "supplierIndex";
        return view('sections.supplier.view', compact('findSupplier', 'backRoute'));
    }

    public function destroy($id)
    {
        $deleteSupplier = supplier::find($id)->delete();

        if($deleteSupplier){
            return redirect()
                    ->route('supplier.index')
                    ->with('success',  'The Supplier was successful removed' );
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
