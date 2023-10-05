<?php

namespace App\Services\OutgoingGoodsProduks;

use LaravelEasyRepository\Service;
use App\Repositories\OutgoingGoodsProduks\OutgoingGoodsProduksRepository;

class OutgoingGoodsProduksServiceImplement extends Service implements OutgoingGoodsProduksService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(OutgoingGoodsProduksRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
