<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'description',
        'min_stock',
        'purchase_price',
        'sell_price' // Tadi kamu tulis 'sell_prices' (kelebihan huruf s)
    ];

    public function categories()
    {
        // Jika model kategori kamu namanya 'Categories', maka:
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
