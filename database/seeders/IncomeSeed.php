<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncomeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = IncomeCategory::all();
        $startDate = now()->subMonth();
        $cash = \App\Models\PettyCash::first();
        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'income_category_id' => $category->random()->id,
                'user_id' => 1,
                'petty_cash_id' => 1,
                'amount' => $amount = rand(20,99) * 1000,
                'description' => 'Income ' . $i,
                'created_at' => $startDate,
                'updated_at' => $startDate,
            ];
            $cash->balance += $amount;
            $startDate = $startDate->addDay();
        }
        $cash->save();
        Income::insert($data);
    }
}
