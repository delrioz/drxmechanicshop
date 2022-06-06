<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DateRangeController extends Controller
{
    
    function index(Request $request)
    {
        if(request()->ajax())
        { 
            // se recebeu uma request ajax

            if(!empty($request->from_name))
            {
                $data = DB::table('products')
                        ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }

            else{
                $data = DB::table('products')
                  ->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }

            return datatables()->of($data)->make(true);
        }
        return view('daterange');
    }
}
