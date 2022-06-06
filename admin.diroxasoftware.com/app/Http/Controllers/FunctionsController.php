<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use DB;
use App\Customer;
use App\machinesallinfos;
use App\Machine;
use App\infowswkinvoice;
use App\newtelephones;
use App\allworkorderinformations;

class FunctionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboardPageSearch(Request $request)
    {

        $name = $request -> searchBox;

        // $result = WorkOrder::where('customer',$name );
        // return ($result);
        
        // return $SearchResult = WorkOrder::Where('customer',$name);
        // return view('sections.functions.searchDashboard', compact('SearchResult'));

        $gettinCustomerData = Customer::where('name', 'LIKE', "%{$name}%")->first();

        if($gettinCustomerData){
            $id = $gettinCustomerData->id;
            $thisCustomer = Customer::find($id);
            $allmachines = Machine::where('owner', 'LIKE', "%{$id}%")->get();
            $allmachineswithowner = machinesallinfos::where('owner', 'LIKE', "%{$id}%")->get();
            $workorder_payments = infowswkinvoice::where('customerId', 'LIKE', "%{$id}%")->get();
            $findNewTelephones = newtelephones::where('owner_id', 'LIKE', $id)->get();
            $allworkOrders = allworkorderinformations::where('customer', 'LIKE', $id)->get();


            return view('sections.customers.viewPage.index', compact('allworkOrders', 'findNewTelephones','thisCustomer','allmachines','allmachineswithowner','workorder_payments'));
    
            // $SearchResult = WorkOrder::where('customer', 'LIKE', "%{$name}%")->get();
            // return view('sections.functions.searchDashboard',compact('SearchResult','name'));
        }

        else{
            return redirect()->back()->with('status', 'No records was found on this name');

        }
        
    }
}
