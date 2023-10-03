<?php

namespace App\Services\Logistic\OutgoingGoods;

use LaravelEasyRepository\Service;
use App\Repositories\OutgoingGoods\OutgoingGoodsRepository;

class OutgoingGoodsServiceImplement extends Service implements OutgoingGoodsService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(OutgoingGoodsRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function create($payload)
  {
    $data = [
      'salespersons_id' => $payload['salesperson_id'],
      'user_id' => auth()->user()->id,
      'description' => $payload['description'],
      'code' => $this->generateCode(),
      'total_price' => $payload['total_price'],
    ];

    $data = $this->mainRepository->create($data);

    foreach ($payload['products']['product_id'] as $key => $value) {
      $data->products()->attach($value, [
        'quantity' => $payload['products']['quantity'][$key],
        'price' => $payload['products']['price'][$key],
        'total_price' => $payload['products']['total_price'][$key],
      ]);
    }
    $data->save();
    $data->load(['products','salesperson','user']);
    return $data;
  }


  private function generateCode()
  {
    $code = 'OG-' . date('Ymd') . '-' . rand(1000, 9999);
    return $code;
  }
}
