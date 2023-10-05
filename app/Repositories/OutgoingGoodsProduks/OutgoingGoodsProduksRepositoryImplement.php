<?php

namespace App\Repositories\OutgoingGoodsProduks;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\OutgoingGoodsProduks;

class OutgoingGoodsProduksRepositoryImplement extends Eloquent implements OutgoingGoodsProduksRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(OutgoingGoodsProduks $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
