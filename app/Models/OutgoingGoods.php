<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'salespersons_id',
        'user_id',
        'produk_id',
        'total_price',
        'description',
    ];

    public function details(){
        return $this->hasMany(OutgoingGoodsProduks::class, 'outgoing_good_id', 'id', 'produk_id');
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function salesperson(){
        return $this->belongsTo(Salesperson::class, 'salespersons_id');
    }

    public function returningGoods(){
        return $this->hasOne(ReturningGoods::class, 'outgoing_good_id');
    }

    public function products(){
        return $this->belongsToMany(Produk::class, OutgoingGoodsProduks::class, 'outgoing_good_id', 'produk_id')->withPivot('quantity', 'price', 'total_price', 'description');
    }

}
