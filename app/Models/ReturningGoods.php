<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturningGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        // 'sales_id',
        'user_id',
        'ongoing_goods_id',
        'petty_cash_id',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    // public function salesperson()
    // {
    //     return $this->belongsTo(Salesperson::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ongoingGoods()
    {
        return $this->belongsTo(OutgoingGoods::class);
    }

    public function pettyCash()
    {
        return $this->belongsTo(PettyCash::class);
    }
}
