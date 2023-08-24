<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'RM000',
                'name' => 'Tebu',
                'price' => 10000,
                'stock' => 100,
                'stock_min' => 10,
                'supplier_id' => 1,
            ],
            [
                'code' => 'RM001',
                'name' => 'Gula',
                'price' => 20000,
                'stock' => 200,
                'stock_min' => 20,
                'supplier_id' => 1,
            ],
            [
                'code' => 'RM002',
                'name' => 'Air',
                'price' => 30000,
                'stock' => 300,
                'stock_min' => 30,
                'supplier_id' => 1,
            ],
            [
                'code' => 'RM003',
                'name' => 'LPG',
                'price' => 40000,
                'stock' => 400,
                'stock_min' => 40,
                'supplier_id' => 1,
            ],
        ];

        \App\Models\RawMaterial::insert($data);
    }
}
