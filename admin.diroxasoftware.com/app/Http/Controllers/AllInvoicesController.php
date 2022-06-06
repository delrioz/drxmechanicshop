<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\allworkorderinformations;
use App\allquotesinformations;
use App\allasales;
use DB;

class AllInvoicesController extends Controller
{
    public function index()
    {
        
        $todayDate =  date('Y-m-d');


        $allworkOrders = allworkorderinformations::where('status', '=', '1')->
        whereDate('created_at', '=', $todayDate) 
        ->get();

        $allquotes = allquotesinformations::where('status' , '=', '1')->
        whereDate('created_at', '=', $todayDate) 
        ->get();

        $allsales = DB::table('allasales')
        ->whereDate('created_at', '=', $todayDate) 
        ->get();


        // $allworkOrders = allworkorderinformations::where('status', '=', '1')->get();

        // $allquotes = allquotesinformations::where('status', '=', '1')->get();

        // $allsales = allasales::where('status', '=', '1')->get();


        // $allsales = allasales::where('status', 0)->get();

        return view('sections.allinvoices.index', compact('allworkOrders', 'allquotes', 'allsales'));
    }

    public function search(Request $request)
    {

        // return $request;/

        $start = $request->dataComecoPadraoDateTime;
        $end = $request->dataFimPadraoDateTime;

        

        if($start == null || $end == null)
        {
            // return redirect()
            // ->back()
            // ->with('error',  'The date you entered for the start date is invalid' );

            $start = "undefined";
            $end = "undefined";
        }



            // $allworkOrders = allworkorderinformations::where('status', '=', '1')
            // ->whereBetween('created_at', [$start, $end])->get();
            
            
            // $allquotes = allquotesinformations::where('status' , '=', '1')
            // ->WhereBetween('created_at', [$start, $end])->get();


            // $allsales = allasales::whereBetween('created_at', [$start, $end])->get();

         
            $allsales = DB::table('allasales')
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->get();

            $allquotes = DB::table('allquotesinformations')
            ->where('status' , '=', '1')
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->get();

            $allworkOrders = DB::table('allworkorderinformations')
            ->where('status' , '=', '1')
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->get();


            $start = date('d/m/Y', strtotime($start));
            $end = date('d/m/Y', strtotime($end));


            // return view('sections.allinvoices.index', compact('allworkOrders', 'allquotes', 'allsales'));

            return $datasFound = ['allworkOrders' => $allworkOrders,
                'allquotes' => $allquotes,
                'allsales' => $allsales,
                'start' => $start,
                'end' => $end
            ];

    
    }
}
