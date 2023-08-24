<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ExpenseCategory::insert([['name' => 'Denda'], ['name' => 'Operasional'], ['name' => 'Lainnya']]);
    }
}
