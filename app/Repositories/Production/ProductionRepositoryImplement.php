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
        $data = $this->model->with(['product', 'detail']);

        // Add a calculated field 'time_difference' to the query
        $data = $data->selectRaw('*, TIMESTAMPDIFF(HOUR, updated_at, created_at) AS period');

        $data = $params && isset($params['paginate'])
            ? $data->paginate($params['paginate'])
            : $data->get();

        return $data;
    }
}
