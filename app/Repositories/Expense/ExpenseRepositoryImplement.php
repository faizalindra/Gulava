<?php

namespace App\Repositories\Expense;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Expense;

class ExpenseRepositoryImplement extends Eloquent implements ExpenseRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Expense $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
