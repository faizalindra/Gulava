<?php

namespace App\Services\Produks;

use LaravelEasyRepository\Service;
use App\Repositories\Produks\ProduksRepository;

class ProduksServiceImplement extends Service implements ProduksService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProduksRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllProduksForTable($params = null)
    {
      return $this->mainRepository->getAllProduksForTable($params);
    }

    public function create($data)
    {
        $data['code'] = $this->generateCode();
        $data['is_active'] = true;
        $data['price'] = (int) $data['price'];
        $data['stock'] = (int) $data['stock'];
        $this->mainRepository->create($data);
    }

    public function getAllProduksForFormSelector(){
      $data = $this->mainRepository->getAllProduksForFormSelector();
      return $data;
    }

    private function generateCode(){
      return 'PRD' . date('YmdHis');
    }
}
