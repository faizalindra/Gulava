<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduksGradeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Grade A',
            ],
            [
                'name' => 'Grade B',
            ],
            [
                'name' => 'Grade C',
            ],
            [
                'name' => 'Grade D',
            ],
        ];

        \App\Models\ProduksGrade::insert($data);
    }
}
