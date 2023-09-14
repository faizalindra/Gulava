<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'produks';

    protected $fillable = [
        'code',
        'name',
        'description',
        'grade',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }

    public function production()
    {
        return $this->hasMany(ProductionBatch::class, 'produks_id', 'id');
    }
    public function grade()
    {
        return $this->belongsTo(ProduksGrade::class, 'grade', 'name');
    }
}
