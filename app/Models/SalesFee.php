<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'sales_id',
        'fee_id',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'integer',
    ];
}
