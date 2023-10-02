<?php

namespace App\Services\Logistic\OutgoingGoods;

use LaravelEasyRepository\Service;
use App\Repositories\OutgoingGoods\OutgoingGoodsRepository;

class OutgoingGoodsServiceImplement extends Service implements OutgoingGoodsService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(OutgoingGoodsRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
