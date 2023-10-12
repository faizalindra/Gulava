<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Other\OtherService;
use App\Models\ReturningGoodsProduks;
use App\Services\Produks\ProduksService;
use App\Services\Salesperson\SalespersonService;
use App\Services\Logistic\OutgoingGoods\OutgoingGoodsService;

class HomeController extends Controller
{
    protected $produksService;
    protected $salespersonService;
    protected $logisticService;
    protected $otherService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProduksService $produksService, OutgoingGoodsService $logisticService, SalespersonService $salespersonService, OtherService $otherService)
    {
        $this->produksService = $produksService;
        $this->logisticService = $logisticService;
        $this->salespersonService = $salespersonService;
        $this->otherService = $otherService;
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
        $sales = $this->otherService->getThisMonthSales();
        $production = $this->otherService->getThisMonthProduction();
        
        // return [
        //     'thisMonthProduction' => $production,
        //     'thisMonthSales' => $sales,
        //     'topSales' => $topSales,
        //     'topProduks' => $topProduks];
        return view('pages.dashboard', compact('topSales', 'topProduks', 'sales','production'));
    }
}
