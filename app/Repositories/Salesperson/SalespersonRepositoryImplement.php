<?php

namespace App\Repositories\Salesperson;

use App\Models\Salesperson;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class SalespersonRepositoryImplement extends Eloquent implements SalespersonRepository
{

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

    public function get5TopSalesperson()
    {
        // get 5 sales person that has higest returning_goods->total_amount
        $currentMonth = now()->month;
        $topSalespersons = Salesperson::select(
            'salespersons.id',
            'salespersons.name',
            DB::raw('SUM(returning_goods.total_amount) as amount'),
            DB::raw('COUNT(returning_goods.id) as count')
        )
            ->join('returning_goods', 'salespersons.id', '=', 'returning_goods.salespersons_id')
            ->whereMonth('returning_goods.created_at', $currentMonth)
            ->groupBy('salespersons.id', 'salespersons.name')
            ->orderByDesc('amount')
            ->take(5)
            ->get();
        return $topSalespersons;
    }
}
