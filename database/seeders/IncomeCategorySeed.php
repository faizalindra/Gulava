<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\IncomeCategory::insert([
            ['name' => 'Lainnya'],
            // ['name' => 'Modal'],
            // ['name' => 'Penjualan'],
            // ['name' => 'Pendapatan Lainnya']
        ]);
    }
}
