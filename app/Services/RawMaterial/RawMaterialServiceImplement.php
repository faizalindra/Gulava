<?php

namespace App\Services\RawMaterial;

use LaravelEasyRepository\Service;
use App\Repositories\RawMaterial\RawMaterialRepository;
use Illuminate\Support\Facades\DB;

class RawMaterialServiceImplement extends Service implements RawMaterialService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RawMaterialRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function update($id, array $data)
  {
    DB::beginTransaction();
    try {
      $this->mainRepository->update($id, $data);
      $material = $this->mainRepository->find($id);
      foreach ($data['suppliers'] as $supplier) {
        if (!$material->suppliers->contains($supplier)) {
          $material->suppliers()->attach($supplier);
        }
      }

      return DB::commit();
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function getAllRawMaterialForTable($request = null)
  {
    return $this->mainRepository->getAllRawMaterialForTable($request);
  }

  public function getAllRawMaterialForFormSelector()
  {
    return $this->mainRepository->getAllRawMaterialForFormSelector();
  }
}
