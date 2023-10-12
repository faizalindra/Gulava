<?php

namespace App\Repositories\Produks;

use LaravelEasyRepository\Repository;

interface ProduksRepository extends Repository{

    public function getAllProduksForTable($request = null);
    public function getAllProduksForFormSelector();
    public function get5TopProduks();
}
