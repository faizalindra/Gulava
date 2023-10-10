<?php

namespace App\Repositories\Income;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Income;

class IncomeRepositoryImplement extends Eloquent implements IncomeRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Income $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
