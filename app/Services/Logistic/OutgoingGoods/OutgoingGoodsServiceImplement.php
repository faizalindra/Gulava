<?php

namespace App\Services\Logistic\OutgoingGoods;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\OutgoingGoods\OutgoingGoodsRepository;
use App\Repositories\Produks\ProduksRepository;

class OutgoingGoodsServiceImplement extends Service implements OutgoingGoodsService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $detailRepository;
  protected $productsRepository;

  public function __construct(OutgoingGoodsRepository $mainRepository, 
  OutgoingGoodsRepository $detailRepository,
  ProduksRepository $productsRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->detailRepository = $detailRepository;
    $this->productsRepository = $productsRepository;
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
      $product = $this->productsRepository->find($value);
      $product->stock -= $payload['products']['quantity'][$key];
      $product->save();
    }
    $data->save();
  }

  public function update($id, array $data)
  {
    DB::beginTransaction();
    try {
      $products = $data['products'];
      $data = [
        'salespersons_id' => $data['salesperson_id'],
        'user_id' => auth()->user()->id,
        'description' => $data['description'],
        'total_price' => $data['total_price'],
      ];

      $this->mainRepository->update($id, $data);
      $data = $this->mainRepository->find($id);
      $data->load('details.products');
      $data->products()->detach();
      foreach ($products['product_id'] as $key => $value) {
        $data->products()->attach($value, [
          'quantity' => $products['quantity'][$key],
          'price' => $products['price'][$key],
          'total_price' => $products['total_price'][$key],
        ]);
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      throw new \Exception($e->getMessage());
    }
  }


  private function generateCode()
  {
    $code = 'OG-' . date('Ymd') . '-' . rand(1000, 9999);
    return $code;
  }
}
