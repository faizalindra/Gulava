<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionController extends Controller
{


    public function create(Request $request)
    {
        dd($request->all());
    }
}
