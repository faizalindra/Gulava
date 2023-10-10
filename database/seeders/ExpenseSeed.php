<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ExpenseCategory::all();
        $startDate = now()->subMonth();
        $cash = \App\Models\PettyCash::first();
        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'expense_categories_id' => $category->random()->id,
                'user_id' => 1,
                'petty_cash_id' => 1,
                'amount' => $amount = rand(20,99) * 1000,
                'description' => 'Income ' . $i,
                'created_at' => $startDate,
                'updated_at' => $startDate,
            ];
            $cash->balance -= $amount;
            $startDate = $startDate->addDay();
        }
        $cash->save();
        Expense::insert($data);
    }
}
