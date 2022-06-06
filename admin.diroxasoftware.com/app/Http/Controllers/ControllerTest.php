<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerTest extends Controller
{
    public function results()
    {
        return view ('testcontrollerviews.results');
    }
}
