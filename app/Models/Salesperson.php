<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'salespersons';

    protected $fillable = [
        'code',
        'nik',
        'name',
        'address',
        'phone',
        'email',
        'gender',
        'birth_date',
        'birth_place',
        'bank_name',
        'bank_account',
        'bank_account_name',
        'npwp',
    ];

    protected $casts = [
        'nik' => 'integer',
        'phone' => 'integer',
        'birth_date' => 'date',
        'npwp' => 'integer',
        'bank_account' => 'integer',
        'is_active' => 'boolean',
    ];
}
