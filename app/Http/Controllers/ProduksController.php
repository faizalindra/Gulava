<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\CreateProdukRequest;
use App\Services\Produks\ProduksService;

class ProduksController extends Controller
{
    protected $mainService;
    public function __construct(ProduksService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function create(CreateProdukRequest $request)
    {
        $data = $request->validated();
        $this->mainService->create($data);
        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
    }
}
