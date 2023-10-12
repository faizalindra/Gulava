<?php

namespace App\Services\Other;

use App\Models\ProductionBatch;
use LaravelEasyRepository\Service;
use App\Models\ReturningGoodsProduks;
use App\Repositories\Other\OtherRepository;

class OtherServiceImplement extends Service implements OtherService{



    public function getThisMonthSales(){
      $thisMonthSales = ReturningGoodsProduks::whereMonth('created_at', date('m'))->sum('total_price');
      $previousMonthSales = ReturningGoodsProduks::whereMonth('created_at', date('m', strtotime('-1 month')))->sum('total_price');
      
      if ($previousMonthSales != 0) {
          $percentageChange = (($thisMonthSales - $previousMonthSales) / $previousMonthSales) * 100;
      } else {
          // Handle the case where previous month sales are zero to avoid division by zero.
          $percentageChange = 0;
      }
      return [
          'thisMonthSales' => $thisMonthSales,
          'percentageChange' => $percentageChange
      ];
    }

    public function getThisMonthProduction(){
      $thisMonthProduction = ProductionBatch::whereMonth('created_at', date('m'))->sum('quantity_produced');
      $previousMonthProduction = ProductionBatch::whereMonth('created_at', date('m', strtotime('-1 month')))->sum('quantity_produced');
      
      if ($previousMonthProduction != 0) {
          $percentageChange = (($thisMonthProduction - $previousMonthProduction) / $previousMonthProduction) * 100;
      } else {
          // Handle the case where previous month sales are zero to avoid division by zero.
          $percentageChange = 0;
      }
      return [
          'thisMonthProduction' => $thisMonthProduction,
          'percentageChange' => number_format($percentageChange, 2)
      ];
    }
}
