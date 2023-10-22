<?php

namespace App\Repositories\OutgoingGoods;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\OutgoingGoods;

class OutgoingGoodsRepositoryImplement extends Eloquent implements OutgoingGoodsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(OutgoingGoods $model)
    {
        $this->model = $model;
    }

    public function generateCode()
    {

        //code format OGG016, OGG019, OGG020, OGG000, OGG001, OGG102
        $lastData = $this->model->orderBy('id', 'desc')->first();
        if ($lastData) {
            $lastCode = $lastData->code;
            $lastNumber = explode('OGG', $lastCode);
            $lastNumber = (int) $lastNumber[1];
            $newNumber = $lastNumber + 1;
            $newCode = 'OGG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            return $newCode;
        } else {
            return 'OGG001';
        }
    }
}
