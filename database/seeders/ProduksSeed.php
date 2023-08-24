<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduksSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'PRD000',
                'grade_id' => 'GRD000',
                'name' => 'Grade A',
                'price' => 10000,
                'estimated_sales' => 100,
                'stock' => 100,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD001',
                'grade_id' => 'GRD001',
                'name' => 'Grade B',
                'price' => 20000,
                'estimated_sales' => 200,
                'stock' => 200,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD002',
                'grade_id' => 'GRD002',
                'name' => 'Grade C',
                'price' => 30000,
                'estimated_sales' => 300,
                'stock' => 300,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD003',
                'grade_id' => 'GRD003',
                'name' => 'Grade D',
                'price' => 40000,
                'estimated_sales' => 400,
                'stock' => 400,
                'description' => '',
                'is_active' => true,
            ],
        ];

        \App\Models\Produk::insert($data);
    }
}
