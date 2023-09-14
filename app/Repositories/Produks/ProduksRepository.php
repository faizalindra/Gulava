<?php

namespace App\Repositories\Produks;

use LaravelEasyRepository\Repository;

interface ProduksRepository extends Repository{

    public function getAllProduksForTable($request = null);
}
