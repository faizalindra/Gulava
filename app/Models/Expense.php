<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'expense_categories_id',
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
        return $this->belongsTo(ExpenseCategory::class, 'expense_categories_id');
    }

    public function cash(){
        return $this->belongsTo(PettyCash::class, 'petty_cash_id');
    }
}
