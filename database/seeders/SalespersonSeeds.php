<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalespersonSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'SP000',
                'nik' => '',
                'name' => 'Guest',
                'address' => '',
                'villege' => '',
                'district' => '',
                'city' => '',
                'phone' => '',
                'email' => '',
                'gender' => 'M',
                'birth_date' => '2000-01-01',
                'birth_place' => '',
                'bank_name' => '',
                'bank_account' => '',
                'bank_account_name' => '',
                'npwp' => '',
            ],
        ];

        \App\Models\Salesperson::insert($data);
    }
}
