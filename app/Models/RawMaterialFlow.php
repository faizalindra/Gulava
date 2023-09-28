<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialFlow extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'raw_material_id',
        'supplier_id',
        'quantity',
        'price',
        'is_in',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
        'is_in' => 'boolean',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
