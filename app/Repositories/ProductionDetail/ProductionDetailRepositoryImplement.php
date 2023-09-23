<?php

namespace App\Repositories\ProductionDetail;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ProductionDetail;

class ProductionDetailRepositoryImplement extends Eloquent implements ProductionDetailRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ProductionDetail $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
