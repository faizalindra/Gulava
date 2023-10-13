<?php

namespace App\Services\Production;

use App\Models\ProductionDetail;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\Produks\ProduksRepository;
use App\Repositories\Production\ProductionRepository;

class ProductionServiceImplement extends Service implements ProductionService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $detailRepository;
  protected $productRepository;

  public function __construct(
    ProductionRepository $mainRepository,
    ProductionDetail $detailRepository,
    ProduksRepository $productRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->detailRepository = $detailRepository;
    $this->productRepository = $productRepository;
  }

  public function create($data)
  {
    DB::beginTransaction();
    try {
      $batchData = [
        'produks_id' => intval($data['produks_id']),
        'description' => $data['description'],
        'code' => $this->generateProductionCode(),
        'quantity_produced' => 0,
        'estimated_cost' => 0,
      ];
      $prodution = $this->mainRepository->create($batchData);

      $jumlahBahanBaku = count($data['materials']['id']);
      $estimatedCost = 0;
      for ($i = 0; $i < $jumlahBahanBaku; $i++) {
        $id = $data['materials']['id'][$i];
        $qty = $data['materials']['quantity_used'][$i];
        $cost = $data['materials']['estimated_cost'][$i];
        $estimatedCost += $cost;
        $materialData = [
          'production_batch_id' => $prodution->id,
          'raw_material_id' => $id,
          'quantity_used' => $qty,
          'estimated_cost' => $cost,
        ];
        $this->detailRepository->create($materialData);
      }

      $prodution->estimated_cost = $estimatedCost;
      $prodution->save();
      
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollBack();
      dd($e->getMessage());
      throw new \Exception($e->getMessage());
    }
  }

  public function finishProduction(int $id, array $data)
  {
    DB::beginTransaction();
    try {
      $production = $this->mainRepository->find($id);
      $production->quantity_produced = $data['quantity_produced'];
      $production->estimated_cost = $data['estimated_cost'];
      $production->completed_at = $data['completed_at'];
      $production->is_active = $data['is_active'];
      $production->save();

      $product = $this->productRepository->find($production->produks_id);
      $product->stock += $data['quantity_produced'];
      $product->save();

      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollBack();
      throw new \Exception($e->getMessage());
    }
  }

  public function getAllProductionForTable(array|null $params = null)
  {
    return $this->mainRepository->getAllProductionForTable($params);
  }

  public function getDetailProduction(int $id)
  {
    return $this->mainRepository->getDetailProduction($id);
  }


  private function generateProductionCode()
  {
    return 'PRD-' . date('ym') . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
  }
}
