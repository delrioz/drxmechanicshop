<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $allproducts = Product::all();
        return view('sections.reports.products.index', compact('allproducts'));
    }
}
