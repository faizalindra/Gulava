<?php

namespace App\Services\Salesperson;

use LaravelEasyRepository\Service;
use App\Repositories\Salesperson\SalespersonRepository;

class SalespersonServiceImplement extends Service implements SalespersonService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SalespersonRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllSalespersonForSelect()
    {
        return $this->mainRepository->getAllSalespersonForSelect();
    }

    public function get5TopSalesperson()
    {
        return $this->mainRepository->get5TopSalesperson();
    }
}
