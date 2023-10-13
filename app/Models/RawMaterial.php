<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'code',
        'name',
        'price',
        'unit',
        'stock',
        'stock_min',
        'supplier_id',
    ];

    protected $casts = [
        'price' => 'integer',
        'unit' => 'string',
        'stock' => 'integer',
        'stock_min' => 'integer',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'raw_material_supplier', 'raw_material_id', 'supplier_id');
    }

    public function flows()
    {
        return $this->hasMany(RawMaterialFlow::class)->orderBy('created_at', 'desc');
    }

    
}
