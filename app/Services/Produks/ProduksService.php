<?php

namespace App\Services\Produks;

use LaravelEasyRepository\BaseService;

interface ProduksService extends BaseService{

    public function getAllProduksForTable(array|null $params = null);
    public function getAllProduksForFormSelector();
    public function get5TopProduks();
}
