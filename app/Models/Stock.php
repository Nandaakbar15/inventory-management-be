<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    protected $table = "stock";
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'quantity', 'location'];


    public function product()
    {
        return $this->belongsTo('product_id', Product::class);
    }

    use HasFactory;
}
