<?php

namespace App\Repositories\RawMaterial;

use LaravelEasyRepository\Repository;

interface RawMaterialRepository extends Repository{

    public function getAllRawMaterialForTable(array|null $request = null);
    public function getAllRawMaterialForFormSelector();
}
