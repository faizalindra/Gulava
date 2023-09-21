<?php

namespace App\Services\RawMaterial;

use LaravelEasyRepository\BaseService;

interface RawMaterialService extends BaseService{

    public function getAllRawMaterialForTable(array|null $request = null);
    public function getAllRawMaterialForFormSelector();
}
