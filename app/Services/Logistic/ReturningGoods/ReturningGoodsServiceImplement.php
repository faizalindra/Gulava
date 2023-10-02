<?php

namespace App\Services\Logistic\ReturningGoods;

use LaravelEasyRepository\Service;
use App\Repositories\ReturningGoods\ReturningGoodsRepository;

class ReturningGoodsServiceImplement extends Service implements ReturningGoodsService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ReturningGoodsRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
