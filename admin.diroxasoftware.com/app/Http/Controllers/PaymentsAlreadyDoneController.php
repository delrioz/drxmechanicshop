<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\allwkpaymentsinfos;
use App\Customer;
use DB;

class PaymentsAlreadyDoneController extends Controller
{
    public function index($id = null)
    {
        // $workorder_payments= allwkpaymentsinfos::where('owner', '=', $id)->get();

        if($id == null){
            $workorder_payments= allwkpaymentsinfos::all();
            $thisCustomer = Customer::all();
            $thisCustomer = 0;
            $thisCustomerStatus = 0;

            // COUNT TABLES

            $NthisCustomerMachines = DB::table('machinesallinfos')
            ->where('owner', $id)
            ->count('*');

            $NthisCustomerWK = DB::table('work_order')
                    ->where('customer', $id)
                    ->count('*');

            $NbikesBought = 0;

            $NthisCustomerProductsBought = DB::table('sales')
                    ->where('chooseCustomer', $id)
                    ->count('*');
        }
        else{

            $thisCustomer = Customer::find($id);
            $workorder_payments= allwkpaymentsinfos::where('owner', '=', $id)->get();
            $thisCustomerStatus = 1;

            $NthisCustomerMachines = DB::table('machinesallinfos')
            ->where('owner', $id)
            ->count('*');

            $NthisCustomerWK = DB::table('work_order')
                    ->where('customer', $id)
                    ->count('*');

            $NbikesBought = 0;

            $NthisCustomerProductsBought = DB::table('sales')
                    ->where('chooseCustomer', $id)
                    ->count('*');

            $NthisCustomerWK = DB::table('work_order')
                ->where('customer', $id)
                ->count('*');


            $totalWKpaid = DB::table('wkpaymentsinfos')
                ->where('owner', $id)
                ->sum('amount');

            $NwkPaid = DB::table('wkpaymentsinfos')
                ->where('owner', $id)
                ->count('*');
        }

        return view('sections.paymentsalreadydone.index', compact('thisCustomer','NthisCustomerMachines','NthisCustomerWK',
        'NbikesBought','NthisCustomerProductsBought','thisCustomerStatus', 'workorder_payments', 'totalWKpaid', 'NwkPaid'));
    }
}
