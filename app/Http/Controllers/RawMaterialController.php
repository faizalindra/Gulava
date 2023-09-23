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

    // public function detail($id)
    // {
    //     $rawMaterial = $this->mainService->find($id);
    //     return view('pages.rawmaterial-detail', compact('rawMaterial'));
    // }
    
}
