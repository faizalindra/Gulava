<?php

namespace App\Services\Salesperson;

use LaravelEasyRepository\BaseService;

interface SalespersonService extends BaseService{

    public function getAllSalespersonForSelect();
}
