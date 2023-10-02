<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingGoodsProduks extends Model
{
    use HasFactory;
    protected $table = 'outgoing_goods_produks';
    protected $fillable = [
        'outgoing_good_id',
        'produk_id',
        'quantity',
        'price',
        'total_price',
        'description',
    ];

    public function products(){
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function outgoingGoods(){
        return $this->belongsTo(OutgoingGoods::class);
    }
}
