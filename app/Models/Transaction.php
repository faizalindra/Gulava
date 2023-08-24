<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'user_id', 'total_price', 'paid_price', 'change_price', 'description'];

    protected $casts = [
        'total_price' => 'integer',
        'paid_price' => 'integer',
        'change_price' => 'integer',
    ];
}
