<?php

namespace App\Http\Controllers;

use App\Models\Total;
use Illuminate\Http\Request;

class TotalController extends Controller
{
    public function store(Request $request){

        $save = new Total();
        $save->code = $request->code;
        $save->total_sales = $request->total_sales;
        $save->total_income = $request->total_income;
        $save->month = $request->month;
        $save->user_id = auth()->user()->id;
        $save->save();

        return redirect()->back()->with('alert-success', 'Total value added successfully!');
    }
}
