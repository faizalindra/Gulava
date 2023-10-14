<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturningGoodsProduks extends Model
{
    use HasFactory;
    protected $table = 'produks_returning_goods';
    protected $fillable = [
        'returning_goods_id',
        'produk_id',
        'quantity',
        'price',
        'total_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
        'total_price' => 'integer',
    ];

    public function products()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function returningGoods()
    {
        return $this->belongsTo(ReturningGoods::class);
    }
}
