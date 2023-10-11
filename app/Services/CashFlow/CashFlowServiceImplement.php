<?php

namespace App\Services\CashFlow;

use App\Models\PettyCash;
use LaravelEasyRepository\Service;
use App\Repositories\Income\IncomeRepository;
use App\Repositories\Expense\ExpenseRepository;
use App\Repositories\CashFlow\CashFlowRepository;

class CashFlowServiceImplement extends Service implements CashFlowService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  //  protected $mainRepository;
  protected $incomeRepository;
  protected $expenseRepository;

  public function __construct(IncomeRepository $incomeRepository, ExpenseRepository $expenseRepository)
  {
    $this->incomeRepository = $incomeRepository;
    $this->expenseRepository = $expenseRepository;
  }

  public function create($payload)
  {
    $cash = PettyCash::first();
    $type = $payload['type'];
    $data = [
      'user_id' => auth()->user()->id,
      'amount' => $payload['amount'],
      'petty_cash_id' => 1, // default '1' is 'petty cash
      'description' => $payload['description'],
      'created_at' => date('Y-m-d H:i:s')
    ];
    if ($type == 'income') {
      $data['income_category_id'] = $payload['category_id'];
      $this->incomeRepository->create($data);
      $cash->balance += $data['amount'];
    } else {
      $data['expense_categories_id'] = $payload['category_id'];
      $this->expenseRepository->create($data);
      $cash->balance -= $data['amount'];
    }
    $cash->save();
  }
}
