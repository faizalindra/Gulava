<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);

        $this->call(
            [
                ExpenseCategorySeed::class,
                IncomeCategorySeed::class,
                PettyCashSeed::class,
                
                ProduksGradeSeed::class,
                RawMaterialsSeed::class,
                ProduksSeed::class,
                SuppliersSeed::class,
                SalespersonSeeds::class,
                RawMaterialSupplierSeed::class,
                RawMaterialFlowSeed::class,
                ProductionBatchSeed::class,
                LogisticSeed::class,
                IncomeSeed::class,
                ExpenseSeed::class,
                ]
        );
    }
}
