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
        'total_price',
        'description',
    ];

}
