<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Produks\ProduksService;
use App\Services\Production\ProductionService;
use App\Services\RawMaterial\RawMaterialService;
use App\Http\Requests\Production\CreateProductionRequest;
use App\Http\Requests\Production\FinishProductionRequest;

// use App\Http\Requests\Production\CreateProductionRequest;

class ProductionController extends Controller
{
    protected $mainService;
    protected $produksService;
    protected $rawMaterialService;
    public function __construct(
        ProductionService $mainService,
        ProduksService $produksService,
        RawMaterialService $rawMaterialService
    ) {
        $this->mainService = $mainService;
        $this->produksService = $produksService;
        $this->rawMaterialService = $rawMaterialService;
    }

    public function index()
    {
        $productions = $this->mainService->getAllProductionForTable();
        $products = $this->produksService->getAllProduksForFormSelector();
        $materials = $this->rawMaterialService->getAllRawMaterialForFormSelector();
        return view("pages.production", compact('productions', 'products', 'materials'));
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

    public function detail($id)
    {
        $production = $this->mainService->getDetailProduction($id);
        $production->load('product', 'detail.rawMaterial');
        return view('pages.production-detail', compact('production'));
    }

    public function getProduks()
    {
        $produks = $this->mainService->getAllProductionForTable(['paginate' => 10]);
        return response()->json($produks);
    }

    public function finish(FinishProductionRequest $request, $id)
    {
        $request = $request->validated();
        $this->mainService->update($id, $request);
        return back()->with('success', 'Produksi berhasil diselesaikan');
    }
}
