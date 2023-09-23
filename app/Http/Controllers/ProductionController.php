<?php

namespace App\Http\Controllers;

use App\Http\Requests\Production\CreateProductionRequest;
use Illuminate\Http\Request;
use App\Services\Production\ProductionService;
// use App\Http\Requests\Production\CreateProductionRequest;

class ProductionController extends Controller
{
    protected $mainService;
    public function __construct(ProductionService $mainService)
    {
        $this->mainService = $mainService;
    }


    public function create(CreateProductionRequest $request)
    {
        dd($request->validated());
        $request = $request->validated();
        $this->mainService->create($request);
        return response()->json(['message' => 'Produksi berhasil ditambahkan']);
    }
}
