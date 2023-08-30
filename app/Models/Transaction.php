<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'user_id', 'total_price', 'petty_cash_id', 'paid_price', 'change_price', 'description'];

    protected $casts = [
        'total_price' => 'integer',
        'paid_price' => 'integer',
        'change_price' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class)->withPivot('quantity', 'price', 'total_price');
    }
}
