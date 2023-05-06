<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recieve extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'unit',
        'stock',
        'expiry_date',
        'date_received',
        'product_id',
        'user_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
