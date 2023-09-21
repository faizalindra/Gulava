<?php

namespace App\Repositories\RawMaterial;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RawMaterial;

class RawMaterialRepositoryImplement extends Eloquent implements RawMaterialRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(RawMaterial $model)
    {
        $this->model = $model;
    }

    public function getAllRawMaterialForTable($request = null)
    {
        $data = $this->model
            ->with('flows');

        $data = $request && isset($request['paginate'])
            ? $data->paginate($request['paginate'])
            : $data->get();

        return $data;
    }

    public function getAllRawMaterialForFormSelector()
    {
        return $this->model->selectRaw('CONCAT(code, " - ", name) as name, id')->get();
    }
}
