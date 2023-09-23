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
        try {
            $request = $request->validated();
            $this->mainService->create($request);
            return back()->with('success', 'Produksi berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getProduks()
    {
        $produks = $this->mainService->getAllProductionForTable(['paginate' => 10]);
        return response()->json($produks);
    }
}
