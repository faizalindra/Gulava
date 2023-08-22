<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'production_batch_id',
        'product_id',
        'raw_material_id',
        'quantity_used',
        'estimated_cost',
    ];

    protected $casts = [
        'quantity_used' => 'integer',
        'estimated_cost' => 'integer',
    ];
}
