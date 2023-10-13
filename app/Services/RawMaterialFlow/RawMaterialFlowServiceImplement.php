<?php

namespace App\Services\RawMaterialFlow;

use App\Repositories\RawMaterial\RawMaterialRepository;
use LaravelEasyRepository\Service;
use App\Repositories\RawMaterialFlow\RawMaterialFlowRepository;

class RawMaterialFlowServiceImplement extends Service implements RawMaterialFlowService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $materialRepository;

  public function __construct(RawMaterialFlowRepository $mainRepository, RawMaterialRepository $materialRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->materialRepository = $materialRepository;
  }

  public function create($data)
  {
    $data = [
      'raw_material_id' => $data['raw_material_id_'],
      'supplier_id' => $data['supplier_id_'],
      'is_in' => isset($data['is_in_']) ? true : false,
      'quantity' => $data['quantity_'],
      'price' => $data['price_'],
    ];
    $material = $this->materialRepository->find($data['raw_material_id']);
    if ($data['is_in']) $material->stock += $data['quantity'];
    else $material->stock -= $data['quantity'];
    $material->save();
    $this->mainRepository->create($data);
    return true;
  }
}
