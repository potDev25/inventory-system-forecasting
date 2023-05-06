<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recieve;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create(){
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        return view('user.createInventory', compact('suppliers'));
    }

    public function store(Request $request){

        $sale = $request->sales;
        $product_id = $request->product_id;
        //dd($sale);
        //dd($request->all());
        for($i = 0; $i < count($sale); $i++){

        $getproduct = Product::where('user_id', auth()->user()->id)
                    ->where('id', $product_id[$i])
                    ->first();
        
        $receiveProduct = Recieve::where('product_id', $product_id[$i])->first();
        $invent = Inventory::where('product_id', $product_id[$i])->first();
        $invent->sales = $sale[$i] + $invent->sales;
        $invent->update();
        
        $remaining = $getproduct->remaining_quantity - $sale[$i]; 
        $tota_sales = $invent->sales * $receiveProduct->price;
        $income = $tota_sales - $receiveProduct->amount;
        
        $getproduct->remaining_quantity = $remaining;
        $getproduct->update();

        $invent->income = $income;
        $invent->total_sales = $tota_sales;
        $invent->update();

        }

        return redirect()->back()->with('alert-info', 'success');
    }

    public function getInventory(Request $request){
        $inventories = Inventory::where('user_id', Auth::guard('web')->user()->id)
                    ->where('date', $request->date)
                    ->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('components.table', compact('inventories', 'suppliers'));
    }
}
