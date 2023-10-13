<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RawMaterial\CreateRawMaterialRequest;
use Illuminate\Http\Request;
use App\Services\Supplier\SupplierService;
use App\Services\RawMaterial\RawMaterialService;
use App\Http\Requests\RawMaterial\CreateRawMaterialRequest;
use App\Http\Requests\RawMaterial\UpdateRawMaterialRequest;

class RawMaterialController extends Controller
{
    protected $mainService;
    protected $supplierService;
    public function __construct(RawMaterialService $mainService, SupplierService $supplierService)
    {
        $this->mainService = $mainService;
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $rawMaterials = $this->mainService->getAllRawMaterialForTable();
        $suppliers = $this->supplierService->getAllSupplierForSelect();
        return view("pages.RawMaterial.rawmaterial", compact('rawMaterials','suppliers'));
    }

    public function detail($id)
    {
        $material = $this->mainService->find($id);
        $material->load(['suppliers', 'flows.supplier']);
        $suppliers = $this->supplierService->getAllSupplierForSelect();
        // dd($material);
        // return $material->toArray();
        return view('pages.RawMaterial.rawmaterial-detail', compact('material', 'suppliers'));
    }

    public function create(UpdateRawMaterialRequest $request)
    {
        $payload = $request->validated();
        $this->mainService->create($payload);
        return redirect()->route('raw-material')->with('success', 'Berhasil menambahkan data bahan baku');
    }

    public function update($id, UpdateRawMaterialRequest $request){
        $payload = $request->validated();
        $this->mainService->update($id, $payload);
        return redirect()->route('raw-material.detail', $id)->with('success', 'Berhasil mengubah data bahan baku');
    }
    
}
