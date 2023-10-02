<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturningGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'salespersons_id',
        'user_id',
        'outgoing_good_id',
        'petty_cash_id',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outgoingGoods()
    {
        return $this->belongsTo(OutgoingGoods::class, 'outgoing_good_id', 'id');
    }

    public function pettyCash()
    {
        return $this->belongsTo(PettyCash::class);
    }

    public function products(){
        return $this->belongsToMany(Produk::class, 'produks_returning_goods', 'returning_goods_id', 'produk_id')->withPivot('quantity', 'price', 'total_price');
    }
}
