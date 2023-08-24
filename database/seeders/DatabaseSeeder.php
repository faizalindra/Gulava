<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersSeed::class,
            SuppliersSeed::class,
            SalespersonSeeds::class,
            RawMaterialsSeed::class,
            ProduksSeed::class,
            PettyCashSeed::class,
            ExpenseCategorySeed::class,
            IncomeCategorySeed::class,

            // ExpenseCategoriesSeed::class,
            // PettyCashSeed::class,
            // ExpensesSeed::class,
        ]);
    }
}
