<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'salesperson_id',
        'user_id',
        'produk_id',
        'total_price',
        'description',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function salesperson(){
        return $this->belongsTo(Salesperson::class);
    }

    public function returningGoods(){
        return $this->hasOne(ReturningGoods::class);
    }

    public function products(){
        return $this->belongsToMany(Produk::class, 'outgoing_goods_produks', 'outgoing_good_id', 'produk_id')->withPivot('quantity', 'price', 'total_price', 'description');
    }

}
