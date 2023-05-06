<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSupplierController extends Controller
{
    public function index(Request $request){
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $supplier_name = Supplier::where('id', $request->id)->first();
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        $supplier_id = $request->id;
        $products = Product::where('user_id', auth()->user()->id)
                            ->where('supplier_id', $request->id)
                            ->get();

        return view('user.products-supplier', compact('suppliers', 'month', 'categories', 'supplier_name', 'supplier_id', 'products'));
    }
}
