<?php

namespace App\Services\Logistic\ReturningGoods;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Models\ReturningGoodsProduks;
use App\Repositories\OutgoingGoods\OutgoingGoodsRepository;
use App\Repositories\Produks\ProduksRepository;
use App\Repositories\ReturningGoods\ReturningGoodsRepository;

class ReturningGoodsServiceImplement extends Service implements ReturningGoodsService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $outgoingGoodsRepository;
  protected $productRepository;

  public function __construct(
    ReturningGoodsRepository $mainRepository,
    OutgoingGoodsRepository $outgoingGoodsRepository,
    ProduksRepository $productRepository
  ) {
    $this->mainRepository = $mainRepository;
    $this->outgoingGoodsRepository = $outgoingGoodsRepository;
    $this->productRepository = $productRepository;
  }

  public function create($data)
  {
    DB::beginTransaction();
    try{
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
  
      foreach ($outgoingGoods->products as $key => $value) {
        if ($outgoingGoods->products[$key]->name == $data['products_']['name'][$key]) {
          $quantityDIff = $outgoingGoods->products[$key]->pivot->quantity - $data['products_']['quantity'][$key];
          $outgoingGoods->products[$key]->stock += $quantityDIff;
          $outgoingGoods->products[$key]->save();
        }
      }
  
      //insert this as pivot table
      for ($i = 0; $i < count($data['products_']['name']); $i++) {
        $payload = [
          'produk_id' => $data['products_']['produk_id'][$i],
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
  
      // return $returningGoods->load(['products', 'user', 'salesFee']);
      DB::commit();
      return true;
    }catch(\Exception $e){
      DB::rollBack();
      throw $e;
    }
;
  }


  private function generateCode($is_returning_goods = true)
  {
    if ($is_returning_goods) {
      $prefix = 'RG';
    } else {
      $prefix = 'FE';
    }
    return $prefix . '-' . date('Ymd') . '-' . rand(1000, 9999);
  }
}
