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
                'code' => '0',
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

        //generate 5 random supplier
        for ($i = 0; $i < 5; $i++) {
            $suppliers[] = [
                'code' => 'SUP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => 'Supplier ' . $i,
                'address' => 'Jl. Supplier ' . $i,
                'phone' => '08123456789',
                'email' => 'supplier' . $i . '@mail.com',
                'contact_person' => 'Contact Person ' . $i,
                'contact_person_phone' => '08123456789',
                'contact_person_email' => 'cp' . $i . '@mail.com',
                'is_active' => true,
            ];
        }

        Supplier::insert($suppliers);
    }
}
