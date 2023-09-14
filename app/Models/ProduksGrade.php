<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduksGrade extends Model
{
    use HasFactory, SoftDeletes;

    public function produks()
    {
        return $this->hasMany(Produk::class, 'grade', 'name');
    }
}
