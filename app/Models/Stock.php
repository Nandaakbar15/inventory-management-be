<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    protected $table = "stocks";
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'quantity', 'location'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    use HasFactory;
}
