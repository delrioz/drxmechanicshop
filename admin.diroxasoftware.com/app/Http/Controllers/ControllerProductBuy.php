<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ControllerProductBuy extends Controller
{
    public function index()
    {
        $allproducts = Product::all();
        return view('buyProduct.index', compact('allproducts'));
    }

    public function confirmbuy(Request $request)
    {
        $dataConfirmBuy = $request;
        $product = $dataConfirmBuy->product;
        return view('buyProduct.confirmbuy',compact('dataConfirmBuy'));
    }
    
}
