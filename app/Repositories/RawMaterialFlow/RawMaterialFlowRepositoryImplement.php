<?php

namespace App\Repositories\RawMaterialFlow;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RawMaterialFlow;

class RawMaterialFlowRepositoryImplement extends Eloquent implements RawMaterialFlowRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(RawMaterialFlow $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
