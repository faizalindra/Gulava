<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionBatch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'produks_id',
        'code',
        'quantity_produced',
        'estimated_cost',
        'description',
        'completed_at',
        'is_active',
    ];

    protected $casts = [
        'quantity_produce' => 'integer',
        'estimated_cost' => 'integer',
        'is_active' => 'boolean',
    ];

    public function detail()
    {
        return $this->hasMany(ProductionDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'produks_id', 'id');
    }
}
