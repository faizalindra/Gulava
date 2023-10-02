<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutgoingGoods;
use App\Services\Salesperson\SalespersonService;
use App\Http\Requests\Logistic\CreateOutgoingGoodsRequest;
use App\Services\Logistic\OutgoingGoods\OutgoingGoodsService;
use App\Services\Logistic\ReturningGoods\ReturningGoodsService;
use App\Services\Produks\ProduksService;

class LogisticController extends Controller
{
    protected $outgoingGoodsService;
    protected $returningGoodsService;
    protected $salespersonService;
    protected $productService;

    public function __construct(OutgoingGoodsService $outgoingGoodsService, ReturningGoodsService $returningGoodsService, SalespersonService $salespersonService, ProduksService $productService)
    {
        $this->outgoingGoodsService = $outgoingGoodsService;
        $this->returningGoodsService = $returningGoodsService;
        $this->salespersonService = $salespersonService;
        $this->productService = $productService;
    }

    public function index()
    {
        $outgoingGoods = OutgoingGoods::with(['user', 'salesperson', 'returningGoods.products', 'products'])->get();
        $salesperson = $this->salespersonService->getAllSalespersonForSelect();
        $products = $this->productService->getAllProduksForFormSelector();
        return view('pages.Logistic.logistic', compact('outgoingGoods', 'salesperson', 'products'));
    }

    public function detail($id)
    {
        $outgoingGoods = OutgoingGoods::with(['user', 'salesperson', 'returningGoods.products', 'products'])->find($id);
        $salesperson = $this->salespersonService->getAllSalespersonForSelect();
        return view('pages.Logistic.logistic-detail', compact('outgoingGoods', 'salesperson'));
    }

    public function create(CreateOutgoingGoodsRequest $request)
    {
        // dd($request->input());
        $request = $request->validated();
        dd($request);
        $this->outgoingGoodsService->create($request);
        return redirect()->route('logistic.index')->with('success', 'Berhasil menambahkan data');
    }
}
