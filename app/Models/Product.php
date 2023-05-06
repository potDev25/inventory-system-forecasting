<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "product_name",
        "product_category",
        "product_description",
        "selling_price",
        "quantity_stock",
        "expiray",
        "capital",
        "remaining_quantity"
    ];

    use HasFactory;

    public function inventories(){
        return $this->hasMany(Inventory::class);
    }

    public function received(){
        return $this->hasMany(Recieve::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
