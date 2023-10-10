<?php

namespace Database\Seeders;

use App\Models\OutgoingGoods;
use App\Models\OutgoingGoodsProduks;
use App\Models\Salesperson;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogisticSeed extends Seeder
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
        $count = 200;
        $salespersonID = Salesperson::all();
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $salesPersonSelector = rand(0, count($salespersonID) - 1);
            $data[] = [
                'code' => 'OGG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'salespersons_id' =>  $salespersonID[$salesPersonSelector]->id,
                'user_id' => 1,
                'total_price' => 0,
                'description' => $this->faker->text(5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        OutgoingGoods::insert($data);

        $outgoingGoods = OutgoingGoods::all();
        $products = \App\Models\Produk::all();
        $cash = \App\Models\PettyCash::first();
        $data = [];
        foreach ($outgoingGoods as $og) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $randomProductSelector = rand(0, count($products) - 1);
                $data[] = [
                    'outgoing_good_id' => $og->id,
                    'produk_id' => $products[$randomProductSelector]->id,
                    'quantity' => $qty = rand(1, 10),
                    'price' => $price = $products[$randomProductSelector]->price,
                    'total_price' => $qty * $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $og->total_price += $qty * $price;
            }
        }
        $outgoingGoods->each->save();
        OutgoingGoodsProduks::insert($data);

        $outgoingGoods->load('products');
        $returningGoods = [];
        $salesFees = [];
        foreach ($outgoingGoods as $og) {
            $returningGoods[] = [
                'code' => 'RTG' . str_pad($og->id, 3, '0', STR_PAD_LEFT),
                'petty_cash_id' => 1,
                'user_id' => 1,
                'salespersons_id' => $og->salespersons_id,
                'outgoing_good_id' => $og->id,
                'total_amount' => $total = $og->total_price - ($og->total_price * 0.1),
                'description' => $this->faker->text(5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $cash->balance += $total;

            $salesFees[] = [
                'code' => 'SF' . str_pad($og->id, 3, '0', STR_PAD_LEFT),
                'salespersons_id' => $og->salespersons_id,
                'user_id' => 1,
                'returning_goods_id' => $og->id,
                'price' => $og->total_price * 0.1,
                'description' => $this->faker->text(5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $cash->save();
        \App\Models\ReturningGoods::insert($returningGoods);
        \App\Models\SalesFee::insert($salesFees);
        $returningGoods = \App\Models\ReturningGoods::with('outgoingGoods')->get();
        $data = [];
        foreach ($returningGoods as $rg) {
            foreach ($rg->outgoingGoods->products as $ogp) {
                $data[] = [
                    'returning_goods_id' => $rg->id,
                    'produk_id' => $ogp->id,
                    'quantity' => $ogp->pivot->quantity,
                    'price' => $ogp->pivot->price,
                    'total_price' => $ogp->pivot->total_price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        \App\Models\ReturningGoodsProduks::insert($data);
    }
}
