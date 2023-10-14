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
        return $this->hasMany(ProductionBatch::class, 'produks_id', 'id')->orderBy('created_at', 'desc');
    }
    public function grade()
    {
        return $this->belongsTo(ProduksGrade::class, 'grade', 'name');
    }

    public function outgoingGoods()
    {
        return $this->belongsToMany(OutgoingGoods::class, 'outgoing_goods_produks', 'produk_id', 'outgoing_good_id');
    }

    public function returningGoods()
    {
        return $this->belongsToMany(ReturningGoods::class, 'produks_returning_goods', 'returning_goods_id', 'produk_id');
    }
}
