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
                ProduksSeed::class,
                ExpenseCategorySeed::class,
                IncomeCategorySeed::class,
                PettyCashSeed::class,
                SuppliersSeed::class,
                SalespersonSeeds::class,
                RawMaterialsSeed::class,
                RawMaterialSupplierSeed::class,
                RawMaterialFlowSeed::class,
                ProduksGradeSeed::class,
                ProductionBatchSeed::class,
                LogisticSeed::class,
                IncomeSeed::class,
                ExpenseSeed::class,
                ]
        );
    }
}
