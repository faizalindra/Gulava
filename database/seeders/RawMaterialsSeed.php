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
                'unit' => 'kg', // tambahkan field unit di migration 'raw_materials
                'stock_min' => 10,
            ],
            [
                'code' => 'RM001',
                'name' => 'Nira',
                'price' => 20000,
                'stock' => 200,
                'unit' => 'kg', // tambahkan field unit di migration 'raw_materials
                'stock_min' => 20,
            ],
            [
                'code' => 'RM002',
                'name' => 'Air',
                'price' => 30000,
                'stock' => 300,
                'unit' => 'kg', // tambahkan field unit di migration 'raw_materials
                'stock_min' => 30,
            ],
            [
                'code' => 'RM003',
                'name' => 'LPG',
                'price' => 40000,
                'stock' => 400,
                'unit' => 'pcs', // tambahkan field unit di migration 'raw_materials
                'stock_min' => 40,
            ],
        ];

        \App\Models\RawMaterial::insert($data);
    }
}
