<?php

namespace App\Http\Controllers;

use App\Models\OutgoingGoods;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    
    public function index()
    {
        $outgoingGoods = OutgoingGoods::with(['user', 'salesperson','returningGoods.products','products'])->get();
        return view('pages.Logistic.logistic', compact('outgoingGoods'));
    }
}
