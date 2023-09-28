<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\BaseService;

interface SupplierService extends BaseService{

    public function getAllSupplierForSelect();
}
