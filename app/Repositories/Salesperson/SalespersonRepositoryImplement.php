<?php

namespace App\Repositories\Salesperson;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Salesperson;

class SalespersonRepositoryImplement extends Eloquent implements SalespersonRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Salesperson $model)
    {
        $this->model = $model;
    }

    public function getAllSalespersonForSelect()
    {
        return $this->model->selectRaw('id, CONCAT(code, "-", name) as name')->get();
    }
}
