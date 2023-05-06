<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        "date" ,
        "month" ,
        "product_name" ,
        "quantity" ,
        "tax5",
        "total_sale",
        "payment" ,
        "gross_margin_percentage",
        "gross_income"
    ];

    public function scopeFilter($query, array $filter) {
        if($filter['tag'] ?? false){
            $query->where('month', request('month'));
        }

    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function receive(){
        return $this->belongsTo(Recieve::class);
    }
}
