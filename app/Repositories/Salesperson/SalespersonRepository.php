<?php

namespace App\Repositories\Salesperson;

use LaravelEasyRepository\Repository;

interface SalespersonRepository extends Repository{

    public function getAllSalespersonForSelect();
}
