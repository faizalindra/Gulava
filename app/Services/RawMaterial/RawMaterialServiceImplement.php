<?php

namespace App\Services\RawMaterial;

use LaravelEasyRepository\Service;
use App\Repositories\RawMaterial\RawMaterialRepository;

class RawMaterialServiceImplement extends Service implements RawMaterialService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(RawMaterialRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllRawMaterialForTable($request = null)
    {
      return $this->mainRepository->getAllRawMaterialForTable($request);
    }
}
