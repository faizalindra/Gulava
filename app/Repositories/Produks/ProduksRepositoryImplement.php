<?php

namespace App\Repositories\Produks;

use App\Models\Produk;
use LaravelEasyRepository\Implementations\Eloquent;

class ProduksRepositoryImplement extends Eloquent implements ProduksRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Produk $model)
    {
        $this->model = $model;
    }

    public function getAllProduksForTable($request = null)
    {
        // Start by building the base query with the withCount
        $query = $this->model->withCount(['production' => function ($query) {
            $query->whereNull('completed_at');
        }])->with('production');

        // Use a ternary operator to conditionally apply pagination or get all results
        $produks = $request && isset($request['paginate'])
            ? $query->paginate($request['paginate'])
            : $query->get();

        // Iterate through the products
        foreach ($produks as $produk) {
            // Check if there is no production history for the product
            $noProductionHistory = $produk->production->isEmpty();

            if ($noProductionHistory) {
                $produk->is_production = false;
            } else {
                // Check the count of ProductionBatch records with completed_at = null
                $ongoingProductionCount = $produk->production_count;

                if ($ongoingProductionCount > 0) {
                    $produk->is_production = true;
                } else {
                    $produk->is_production = false;
                }
            }

            // Remove the production_count attribute if you don't need it in the response
            unset($produk->production_count);
        }

        return $produks;
    }

    public function getAllProduksForFormSelector()
    {
        $data = $this->model->selectRaw('CONCAT(code, " - ", name) as name, id')->get();
        return $data;
    }
}
