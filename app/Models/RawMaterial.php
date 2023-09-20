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
        'supplier_id' => 'integer',
    ];

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function flows()
    {
        return $this->hasMany(RawMaterialFlow::class);
    }

    
}
