<?php

namespace App\Repositories\ReturningGoods;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ReturningGoods;

class ReturningGoodsRepositoryImplement extends Eloquent implements ReturningGoodsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ReturningGoods $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
