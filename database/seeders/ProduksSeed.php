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
                'grade' => 'Grade C',
                'name' => 'Asli',
                'price' => 10000,
                'estimated_sales' => 0,
                'stock' => 0,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD001',
                'grade' => 'Grade C',
                'name' => 'Aren',
                'price' => 20000,
                'estimated_sales' => 0,
                'stock' => 0,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD002',
                'grade' => 'Grade B',
                'name' => 'Asli Permium',
                'price' => 30000,
                'estimated_sales' => 0,
                'stock' => 0,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD003',
                'grade' => 'Grade A',
                'name' => 'Asli Super',
                'price' => 40000,
                'estimated_sales' => 0,
                'stock' => 0,
                'description' => '',
                'is_active' => true,
            ],
            [
                'code' => 'PRD004',
                'grade' => 'Grade D',
                'name' => 'Semi Asli',
                'price' => 8000,
                'estimated_sales' => 0,
                'stock' => 0,
                'description' => '',
                'is_active' => true,
            ],
        ];

        \App\Models\Produk::insert($data);
    }
}
