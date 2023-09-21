<?php

namespace App\Services\Production;

use LaravelEasyRepository\BaseService;

interface ProductionService extends BaseService{

    public function getAllProductionForTable(array|null $params = null);
}
