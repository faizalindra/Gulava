<?php

namespace App\Http\Controllers;

use App\Http\Requests\Production\CreateProductionRequest;
use App\Services\Production\ProductionService;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    protected $mainService;
    public function __construct(ProductionService $mainService)
    {
        $this->mainService = $mainService;
    }


    public function create(CreateProductionRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $data = $this->mainService->create($validated);
        return back()->with('success', 'Produksi berhasil ditambahkan');
    }
}
