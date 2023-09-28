<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RawMaterial\RawMaterialService;

class RawMaterialController extends Controller
{
    protected $mainService;
    public function __construct(RawMaterialService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function index()
    {
        $rawMaterials = $this->mainService->getAllRawMaterialForTable();
        return view("pages.rawmaterial", compact('rawMaterials'));
    }

    public function detail($id)
    {
        $material = $this->mainService->find($id);
        $material->load(['flows.supplier','suppliers']);
        // dd($material->toArray());
        return view('pages.RawMaterial.rawmaterial-detail', compact('material'));
    }
    
}
