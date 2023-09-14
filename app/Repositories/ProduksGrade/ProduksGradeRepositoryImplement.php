<?php

namespace App\Repositories\ProduksGrade;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ProduksGrade;

class ProduksGradeRepositoryImplement extends Eloquent implements ProduksGradeRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ProduksGrade $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
