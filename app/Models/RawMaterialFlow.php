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
        'quantity',
        'price',
        'is_in',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
        'is_in' => 'boolean',
    ];
}
