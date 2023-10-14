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
        $count = 20;
        $rawMaterials = \App\Models\RawMaterial::all();
        $rawMaterialCount = count($rawMaterials);
        $supplierCount = \App\Models\Supplier::count();
        $cash = \App\Models\PettyCash::first();
        $data = [];
        for($i = 0; $i < $count; $i++) {
            $data[] = [
                'raw_material_id' => $rawMaterialID = rand(1, $rawMaterialCount),
                'supplier_id' => rand(1, $supplierCount),
                'quantity' => $qty = rand(1, 100),
                'price' => $price = $rawMaterials[$rawMaterialID - 1]->price,
                'is_in' => $is_in = rand(1, 100) > 2 ? true : false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $rawMaterials[$rawMaterialID - 1]->stock += $is_in ? $qty : -$qty;
            $cash->balance += $price;
        }
        $rawMaterials->each->save();
        $cash->save();
        \App\Models\RawMaterialFlow::insert($data);
    }
}
