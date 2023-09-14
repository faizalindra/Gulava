<?php

namespace App\Services\ProduksGrade;

use App\Models\ProduksGrade;
use LaravelEasyRepository\Service;
use App\Repositories\ProduksGrade\ProduksGradeRepository;

class ProduksGradeServiceImplement extends Service implements ProduksGradeService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProduksGradeRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllProduksGrade()
    {
      return ProduksGrade::select('name')->get();
    }
}
