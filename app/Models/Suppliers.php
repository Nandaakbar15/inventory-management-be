<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    /** @use HasFactory<\Database\Factories\SuppliersFactory> */
    protected $table = "suppliers";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'contact_person', 'phone', 'address'];


    use HasFactory;
}
