<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'salespersons_id',
        'user_id',
        'returning_goods_id',
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

    public function returingGoods()
    {
        return $this->belongsTo(ReturningGoods::class);
    }
}
