<?php

namespace App\Http\Controllers;

use App\Http\Requests\RawMaterial\CreateRawMaterialRequest;
use Illuminate\Http\Request;
use App\Services\Supplier\SupplierService;
use App\Services\RawMaterial\RawMaterialService;

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
        return view("pages.rawmaterial", compact('rawMaterials'));
    }

    public function detail($id)
    {
        $material = $this->mainService->find($id);
        $material->load(['suppliers', 'flows.supplier']);
        $suppliers = $this->supplierService->getAllSupplierForSelect();
        // dd($material);
        return view('pages.RawMaterial.rawmaterial-detail', compact('material', 'suppliers'));
    }

    public function update($id, CreateRawMaterialRequest $request){
        $payload = $request->validated();
        $this->mainService->update($id, $payload);
        return redirect()->route('raw-material.detail', $id)->with('success', 'Berhasil mengubah data bahan baku');
    }
    
}
