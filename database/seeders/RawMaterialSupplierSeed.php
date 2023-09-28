<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialSupplierSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = \App\Models\Supplier::all();
        $rawMaterials = \App\Models\RawMaterial::all();
        foreach ($rawMaterials as $rawMaterial) {
            $supplier_count = rand(1, count($suppliers));
            for ($i = 0; $i < $supplier_count; $i++) {
                $supplier_array[] = $suppliers->random()->id;
            }
            $supplier_array = array_unique($supplier_array);
            $rawMaterial->suppliers()->attach($supplier_array);
        }
    }
}
