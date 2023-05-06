<?php

namespace App\Http\Controllers;

use App\Models\BuyProduct;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BuyProductController extends Controller
{
    public function index(Request $request){

        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $products = Product::where('supplier_id', $request->id)->get();
        $supplier_name = Supplier::where('id', $request->id)->first();
        $histories = BuyProduct::where('supplier_id', $request->id)->groupBy('code')->get();

        return view('user.buy-product', compact('suppliers', 'month', 'products', 'supplier_name', 'histories'));

    }

    public function store(Request $request){
        $product_id = $request->product_id;
        $qnty = $request->qnty;
        $code = Str::random(5);

        for($i = 0; $i < count($product_id); $i++){
            $dataSave = [

                'product_id' => $product_id[$i],
                'qnty' => $qnty[$i],
                'user_id' => auth()->user()->id,
                'code' => $code,
                'supplier_id' => $request->id

            ];

            BuyProduct::create($dataSave);
        }

        return redirect('/view-product?code='.$code.'&id='.$request->id);
    }

    public function view_product(Request $request){

        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $products = BuyProduct::where('code', $request->code)->get();
        $supplier_name = Supplier::where('id', $request->id)->first();
        $date = BuyProduct::where('code', $request->code)->first();

        return view('user.view-product', compact('suppliers', 'month', 'products', 'supplier_name', 'date'));

    }
}
