<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ProductController extends Controller
{
    public function index(Product $product){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.products', [
            'products' => $product::where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'DESC')->get(),
            'month' => $month,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request){
        $formField = $request->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_description' => 'required|max:100',
        ]);

        $formField['supplier_id'] = $request->supplier_id;

        $check = Product::where('product_name', $request->product_name)->where('user_id', Auth::guard('web')->user()->id)->count();

        if($check == 0){
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_category = $request->product_category;
            $product->product_description = $request->product_description;
            $product->user_id = auth()->id();
            $product->supplier_id = $request->supplier_id;
            $product->save();

            return redirect()->back()->with('alert-info', 'You added product successfully');
        }else{
            return redirect()->back()->with('alert-danger', 'Product already exist!');
        }
    }

    public function destroy(Request $request){
        Product::where('id', $request->id)->delete();

        return redirect()->back()->with('alert-success', 'Product Deleted Successfully');
    }

    public function getUpdate(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $product = Product::where('id', $request->product_id)->first();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.edit-product', compact('month', 'product', 'categories', 'suppliers'));
    }

    public function update(Request $request){
         $formField = $request->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_description' => 'required|max:100',
        ]);

        $edit = Product::where('id', $request->product_id)->first();
        $edit->product_name = $request->product_name;
        $edit->product_category = $request->product_category;
        $edit->product_description = $request->product_description;
        $edit->update();

        return redirect()->back()->with('alert-info', 'You updated product successfully');
    }
}
