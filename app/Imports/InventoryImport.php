<?php

namespace App\Imports;

use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $inventory = new Inventory([
            "date" => $row['date'],
            "month" => $row['month'],
            "product_name" => $row['product_name'],
            "quantity" => $row['quantity'],
            "tax5" => $row['tax5'],
            "total_sale" => $row['total_sale'],
            "payment" => $row['payment'],
            "gross_margin_percentage" => $row['gross_margin_percentage'],
            "gross_income" => $row['gross_income'],
        ]);

        $inventory->user_id = Auth::guard('web')->user()->id;

        return $inventory;
    }
}
