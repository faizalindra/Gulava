<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cashflow\CreateCashflowRequest;
use App\Models\Income;
use App\Models\Expense;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Services\CashFlow\CashFlowService;

class CashflowController extends Controller
{
    protected $mainService;
    public function __construct(CashFlowService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function index(){
        $cash = PettyCash::first();
        $incomes = Income::whereMonth('created_at', date('m'))->orderBy('created_at','DESC')->get();
        $incomeCategory = IncomeCategory::all();
        $expenses = Expense::whereMonth('created_at', date('m'))->orderBy('created_at','DESC')->get();
        $expenseCategory = ExpenseCategory::all();
        // return [
        //     'cash' => $cash,
        //     'income' => $incomes,
        //     'incomeCategory' => $incomeCategory,
        //     'expense' => $expenses,
        //     'expenseCategory' => $expenseCategory
        // ];
        return view('pages.Cashflow.cashflow', compact('cash', 'incomes', 'incomeCategory', 'expenses','expenseCategory') );
    }

    public function category($type){
        if($type == 'income'){
            $data = IncomeCategory::all();
        }else{
            $data = ExpenseCategory::all();
        }
        return $data;
    }

    public function create(CreateCashflowRequest $request){
        $payload = $request->validated();
        // dd($payload);
        $this->mainService->create($payload);
        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }
}
