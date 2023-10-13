<?php

namespace App\Http\Controllers;

use App\Http\Requests\RawMaterialFlow\CreateRawMaterialFlow;
use App\Services\RawMaterialFlow\RawMaterialFlowService;
use Illuminate\Http\Request;

class RawMaterialFlowController extends Controller
{
    protected $mainService;
    public function __construct(RawMaterialFlowService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function create(CreateRawMaterialFlow $request)
    {
        $data = $request->validated();
        $this->mainService->create($data);
        return back()->with('success', 'Berhasil menambahkan data history bahan baku');
    }
}
