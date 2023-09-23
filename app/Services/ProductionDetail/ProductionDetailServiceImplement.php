<?php

namespace App\Services\ProductionDetail;

use LaravelEasyRepository\Service;
use App\Repositories\ProductionDetail\ProductionDetailRepository;

class ProductionDetailServiceImplement extends Service implements ProductionDetailService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductionDetailRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
