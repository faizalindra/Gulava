<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialFlowSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 200;
        $rawMaterialCount = \App\Models\RawMaterial::count();
        $supplierCount = \App\Models\Supplier::count();
        $data = [];
        for($i = 0; $i < $count; $i++) {
            $data[] = [
                'raw_material_id' => rand(1, $rawMaterialCount),
                'supplier_id' => rand(1, $supplierCount),
                'quantity' => rand(1, 100),
                'price' => rand(1000, 100000),
                'is_in' => rand(1, 100) > 2 ? true : false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        \App\Models\RawMaterialFlow::insert($data);
    }
}
