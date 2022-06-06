<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ControllerProduct extends Controller
{
    public function index()
    {
        return "index";
    }

    public function create()
    {
        return view ("products.indexCreate");
    }

    public function store(Request $request)
    {

        Product::create($request->all());
        return redirect()->route('home');

    }
}
