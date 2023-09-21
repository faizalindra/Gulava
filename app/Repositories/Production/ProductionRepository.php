<?php

namespace App\Repositories\Production;

use LaravelEasyRepository\Repository;

interface ProductionRepository extends Repository{

    public function getAllProductionForTable(array|null $params = null);
}
