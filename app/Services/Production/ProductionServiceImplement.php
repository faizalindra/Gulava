<?php

namespace App\Services\Production;

use LaravelEasyRepository\Service;
use App\Repositories\Production\ProductionRepository;

class ProductionServiceImplement extends Service implements ProductionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllProductionForTable(array|null $params = null)
    {
        return $this->mainRepository->getAllProductionForTable($params);
    }
}
