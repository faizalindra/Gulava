<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuppliersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'code' => 'SUP000',
                'name' => 'Guest',
                'address' => '',
                'phone' => '',
                'email' => '',
                'contact_person' => '',
                'contact_person_phone' => '',
                'contact_person_email' => '',
                'is_active' => true,
            ],
        ];

        Supplier::insert($suppliers);
    }
}
