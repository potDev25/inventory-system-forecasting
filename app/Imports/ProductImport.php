<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product =  new Product([
            "product_name" => $row['product_name'],
            "product_category" => $row['product_category'],
            "product_description" => $row['product_description'],
            "selling_price" => $row['selling_price'],
            "quantity_stock" => $row['quantity_stock'],
        ]);

        $product->user_id = Auth::guard('web')->user()->id;

        return $product;
    }
}
