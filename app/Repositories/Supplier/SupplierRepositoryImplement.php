<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Supplier;

class SupplierRepositoryImplement extends Eloquent implements SupplierRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function getAllSupplierForSelect()
    {
        return $this->model->selectRaw('id, CONCAT(code, "-", name) as name')->where('is_active', true)->where('id', '!=', 1)->get();
    }
}
