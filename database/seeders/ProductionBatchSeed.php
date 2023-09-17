<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Produk;
use App\Models\RawMaterial;
use App\Models\ProductionBatch;
use Illuminate\Database\Seeder;
use App\Models\ProductionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductionBatchSeed extends Seeder
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
        $faker = $this->faker;
        $count = Produk::count();
        $rawMaterials = RawMaterial::all();
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $randomNumberOfBatch = $faker->numberBetween(1, 10);
            for ($j = 0; $j < $randomNumberOfBatch; $j++) {
                $result = $this->batchgenerator($j, $randomNumberOfBatch, $faker);
                $data[] = [
                    'code' => 'PB' . str_pad($i, 3, '0', STR_PAD_LEFT) . str_pad($j, 3, '0', STR_PAD_LEFT),
                    'produks_id' => rand(1, $count),
                    'quantity_produced' => $faker->numberBetween(500, 1000),
                    'estimated_cost' => $faker->numberBetween(100000, 1000000),
                    'description' => $faker->sentence(10),
                    'completed_at' => $result['completed_at'],
                    'is_active' => $result['is_active'],
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ];
            }
        }
        ProductionBatch::insert($data);
        $batchId = ProductionBatch::pluck('id')->toArray();

        // Attach each raw material to the production batch with random quantity_used and estimated_cost
        // $i = 0;
        // foreach ($rawMaterials as $rawMaterial) {
        //     $productionDetail = [
        //         'production_batch_id' => $batchId[$i],
        //         'raw_material_id' => $rawMaterial->id,
        //         'quantity_used' => $faker->numberBetween(100, 500),
        //         'estimated_cost' => $faker->numberBetween(1000, 5000),
        //     ];
        //     $i++;
        //     ProductionDetail::create($productionDetail);
        // }
        $productionDetails = [];
        for($i = 0; $i < count($batchId); $i++){
            for($j=0;$j<count($rawMaterials);$j++){
                $productionDetails[] = [
                    'production_batch_id' => $batchId[$i],
                    'raw_material_id' => $rawMaterials[$j]->id,
                    'quantity_used' => $faker->numberBetween(100, 500),
                    'estimated_cost' => $faker->numberBetween(1000, 5000),
                ];
            }
        }
        ProductionDetail::insert($productionDetails);
    }

    private function batchgenerator($randomNumberOfBatch, $j, $faker)
    {
        if ($randomNumberOfBatch - $j != 1) {
            $batch['completed_at'] = $faker->dateTimeBetween('-1 year', 'now');
            $batch['is_active'] = false;
        } else {
            $batch['completed_at'] = rand(1, 100) > 10 ? $faker->dateTimeBetween('-1 year', 'now') : null;
            $batch['is_active'] = is_null($batch['completed_at']) ? true : false;
        }
        return $batch;
    }
}
