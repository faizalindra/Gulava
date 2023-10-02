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
        $count = 20;
        for($i = 1; $i < $count + 1; $i++){
            $data[] =[
                'code' => 'SP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nik' => $this->faker->nik(),
                'name' => $this->faker->name(),
                'address' => $this->faker->address(),
                'villege' => $this->faker->city(),
                'district' => $this->faker->city(),
                'city' => $this->faker->city(),
                'phone' => $this->faker->phoneNumber(),
                'email' => $this->faker->email(),
                'gender' => $this->faker->randomElement(['M', 'F']),
                'birth_date' => $this->faker->date(),
                'birth_place' => $this->faker->city(),
                'bank_name' => $this->faker->randomElement(['BNI', 'BRI', 'BCA', 'Mandiri']),
                'bank_account' => $this->faker->bankAccountNumber(),
                'bank_account_name' => $this->faker->name(),
                'npwp' => $this->faker->numerify('#############'),
            ];
        }

        \App\Models\Salesperson::insert($data);
    }
}
