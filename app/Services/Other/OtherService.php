<?php

namespace App\Services\Other;

use LaravelEasyRepository\BaseService;

interface OtherService extends BaseService{

    public function getThisMonthSales();
    public function getThisMonthProduction();
}
