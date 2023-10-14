<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalespersonSeeds extends Seeder
{
    protected $faker;
    public function __construct(Factory $faker)
    {
        $this->faker = $faker::create('id_ID');
    }
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
                'phone' => '',
                'email' => '',
                'gender' => 'M',
                'bank_name' => '',
                'bank_account' => '',
                'bank_account_name' => '',
            ],
        ];
        $count = 20;
        for($i = 1; $i < $count + 1; $i++){
            $data[] =[
                'code' => 'SP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nik' => $this->faker->nik(),
                'name' => $this->faker->name(),
                'address' => $this->faker->address(),
                'phone' => $this->faker->phoneNumber(),
                'email' => $this->faker->email(),
                'gender' => $this->faker->randomElement(['M', 'F']),
                'bank_name' => $this->faker->randomElement(['BNI', 'BRI', 'BCA', 'Mandiri']),
                'bank_account' => $this->faker->bankAccountNumber(),
                'bank_account_name' => $this->faker->name(),
            ];
        }

        \App\Models\Salesperson::insert($data);
    }
}
