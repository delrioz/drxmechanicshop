<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerCustomer extends Controller
{
    public function index()
    {
        return "index";
    }

    public function create()
    {
        return "create customer";
    }
}
