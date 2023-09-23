<?php

namespace App\Http\Controllers;

use App\Services\Produks\ProduksService;
use App\Http\Requests\UpdateProdukRequest;
use App\Http\Requests\Produk\CreateProdukRequest;
use App\Services\ProduksGrade\ProduksGradeService;

class ProduksController extends Controller
{
    protected $mainService;
    protected $produksGradeService;

    public function __construct(ProduksService $mainService, ProduksGradeService $produksGradeService)
    {
        $this->mainService = $mainService;
        $this->produksGradeService = $produksGradeService;
    }

    public function index()
    {
        $products = $this->mainService->getAllProduksForTable();
        $grades = $this->produksGradeService->getAllProduksGrade();
        return view("pages.product", compact('products', 'grades'));
    }

    public function detail($id)
    {
        $product = $this->mainService->find($id);
        $product->load(['production' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }]);
        $grades = $this->produksGradeService->getAllProduksGrade();

        return view('pages.product-detail', compact('product', 'grades'));
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
