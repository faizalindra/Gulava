<?php

namespace App\Services\Logistic\ReturningGoods;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Models\ReturningGoodsProduks;
use App\Repositories\OutgoingGoods\OutgoingGoodsRepository;
use App\Repositories\ReturningGoods\ReturningGoodsRepository;

class ReturningGoodsServiceImplement extends Service implements ReturningGoodsService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $outgoingGoodsRepository;

  public function __construct(ReturningGoodsRepository $mainRepository, OutgoingGoodsRepository $outgoingGoodsRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->outgoingGoodsRepository = $outgoingGoodsRepository;
  }

  public function create($data)
  {
    // DB::beginTransaction();
    $outgoingGoods = $this->outgoingGoodsRepository->find($data['id']);
    $payload = [
      'code' => $this->generateCode(),
      'total_amount' => $data['total_price_'],
      'salespersons_id' => $outgoingGoods->salespersons_id,
      'outgoing_good_id' => $outgoingGoods->id,
      'description' => $data['description_'],
      'petty_cash_id' => 1,
      'user_id' => auth()->user()->id,
    ];
    $returningGoods = $this->mainRepository->create($payload);
    // dd($returningGoods);

    //insert this as pivot table
    for ($i = 0; $i < count($data['products_']['name']); $i++) {
      if ($outgoingGoods->products[$i]->name == $data['products_']['name'][$i]) {
        $product_id = $outgoingGoods->products[$i]->id;
      }

      $payload = [
        'produk_id' => $product_id,
        'price' => $data['products_']['price'][$i],
        'quantity' => $data['products_']['quantity'][$i],
        'total_price' => $data['products_']['total_price'][$i],
        'returning_goods_id' => $returningGoods->id,
      ];
      ReturningGoodsProduks::create($payload);
    }

    $payload = [
      'returning_goods_id' => $returningGoods->id,
      'salespersons_id' => $outgoingGoods->salespersons_id,
      'user_id' => auth()->user()->id,
      'price' => $data['sales_fee_'],
      'code' => $this->generateCode(false),
    ];
    $returningGoods->salesFee()->create($payload);

    return $returningGoods->load(['products', 'user', 'salesFee']);
  }


  private function generateCode($is_returning_goods = true)
  {
    if ($is_returning_goods) {
      $prefix = 'RG';
    }else{
      $prefix = 'FE';
    }
    return $prefix . '-' . date('Ymd') . '-' . rand(1000, 9999);
  }
}
