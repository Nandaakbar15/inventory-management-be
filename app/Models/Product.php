<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'description',
        'min_stock',
        'purchase_price',
        'sell_price'
    ];

    public function category()
    {
        return $this->hasMany(Categories::class, 'id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
}
