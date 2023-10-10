<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'income_category_id',
        'petty_cash_id',
        'amount',
        'description',
        'created_at'
    ];

    protected $with = [
        'user',
        'category',
        'cash'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }

    public function cash(){
        return $this->belongsTo(PettyCash::class,'petty_cash_id');
    }
}
