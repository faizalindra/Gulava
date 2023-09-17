<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradeRequest;
use App\Models\Produk;
use App\Models\ProduksGrade;
use Illuminate\Http\Request;

class ProdukGradeController extends Controller
{
    

    public function create(CreateGradeRequest $request){
        $request = $request->validated();
        ProduksGrade::create($request);
        return back()->with('success', 'Grade Produk berhasil ditambahkan');
    }
}
