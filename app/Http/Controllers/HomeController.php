<?php

namespace App\Http\Controllers;

use App\Services\Logistic\OutgoingGoods\OutgoingGoodsService;
use Illuminate\Http\Request;
use App\Services\Produks\ProduksService;
use App\Services\Salesperson\SalespersonService;

class HomeController extends Controller
{
    protected $produksService;
    protected $salespersonService;
    protected $logisticService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProduksService $produksService, OutgoingGoodsService $logisticService, SalespersonService $salespersonService)
    {
        $this->produksService = $produksService;
        $this->logisticService = $logisticService;
        $this->salespersonService = $salespersonService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $topSales = $this->salespersonService->get5TopSalesperson();
        $topProduks = $this->produksService->get5TopProduks();
        // return [
        //     'topSales' => $topSales,
        //     'topProduks' => $topProduks];
        return view('pages.dashboard', compact('topSales', 'topProduks'));
    }
}
