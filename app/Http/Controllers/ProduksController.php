<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\CreateProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
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

    public function update($id, UpdateProdukRequest $request)
    {
        $data = $request->validated();
        $this->mainService->update($id, $data);
        return back()->with('success', 'Produk berhasil diubah');
    }

    public function disable($id)
    {
        $product = $this->mainService->findOrFail($id);
        if (!$product) {
            return redirect()->route('product')->with('error', 'Produk tidak ditemukan');
        }
        $product->is_active = !$product->is_active;
        $product->save();
        return redirect()->route('product')->with('success', 'Produk berhasil diubah');
    }
}
