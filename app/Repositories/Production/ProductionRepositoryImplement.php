<?php

namespace App\Repositories\Production;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Production;
use App\Models\ProductionBatch;

class ProductionRepositoryImplement extends Eloquent implements ProductionRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(ProductionBatch $model)
    {
        $this->model = $model;
    }

    public function getAllProductionForTable($params = null)
    {
        $data = $this->model->all();
        return $data;
    }
}
