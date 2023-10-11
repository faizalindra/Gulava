<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cashflow\CreateCashflowCategoryRequest;
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

    public function index()
    {
        $cash = PettyCash::first();
        $incomes = Income::whereMonth('created_at', date('m'))->orderBy('created_at', 'DESC')->get();
        $incomeCategory = IncomeCategory::where('id', '!=', 1)->get();
        $expenses = Expense::whereMonth('created_at', date('m'))->orderBy('created_at', 'DESC')->get();
        $expenseCategory = ExpenseCategory::where('id', '!=', 1)->get();
        // return [
        //     'cash' => $cash,
        //     'income' => $incomes,
        //     'incomeCategory' => $incomeCategory,
        //     'expense' => $expenses,
        //     'expenseCategory' => $expenseCategory
        // ];
        return view('pages.Cashflow.cashflow', compact('cash', 'incomes', 'incomeCategory', 'expenses', 'expenseCategory'));
    }

    public function create(CreateCashflowRequest $request)
    {
        $payload = $request->validated();
        $this->mainService->create($payload);
        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function category($type)
    {
        if ($type == 'income') {
            $data = IncomeCategory::all();
        } else {
            $data = ExpenseCategory::all();
        }
        return $data;
    }

    public function createCategory(CreateCashflowCategoryRequest $request)
    {
        $payload = $request->validated();
        if ($payload['category_type'] == 'income') {
            IncomeCategory::create([
                'name' => $payload['category_name']
            ]);
        } else {
            ExpenseCategory::create([
                'name' => $payload['category_name']
            ]);
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function deleteCategory($type, $id)
    {
        if ($type == 'income') {
            $data = IncomeCategory::find($id);
            Income::where('expense_categories_id', $id)->update([
                'expense_categories_id' => 1
            ]);
        } else {
            $data = ExpenseCategory::find($id);
            Expense::where('expense_categories_id', $id)->update([
                'expense_categories_id' => 1
            ]);
        }
        $data->delete();
        // return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
