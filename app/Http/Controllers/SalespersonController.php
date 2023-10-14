<?php

namespace App\Http\Controllers;

use App\Http\Requests\Salesperson\CreateSalespersonRequest;
use App\Models\Salesperson;
use App\Services\Salesperson\SalespersonService;
use Illuminate\Http\Request;

class SalespersonController extends Controller
{
    protected $mainService;
    public function __construct(SalespersonService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function index()
    {
        $salespersons = Salesperson::where('id', '>', 1)->get();
        return view('pages.Salesperson.salesperson', compact('salespersons'));
    }

    public function create(CreateSalespersonRequest $request)
    {
        $request = $request->validated();
        $this->mainService->create($request);
        return back()->with('success', 'Sales berhasil ditambahkan');
    }
}
