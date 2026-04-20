<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutations extends Model
{
    /** @use HasFactory<\Database\Factories\StockMutationsFactory> */
    protected $table = "stock_mutations";
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'user_id', 'type', 'quantity', 'reference', 'note'];


    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    use HasFactory;
}
