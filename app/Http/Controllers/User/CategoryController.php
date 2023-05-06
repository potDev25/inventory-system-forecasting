<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    public function index(Product $product){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.categories', [
            'products' => $product::where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'DESC')->get(),
            'month' => $month,
            'categories' => Category::where('user_id', Auth::user()->id)->get(),
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request){

        $formField = $request->validate([
            'product_category' => 'required',
            'description' => 'required',
        ]);

        $check = Category::where('user_id', Auth::user()->id)->where('product_category', $request->product_category)->count();

        if($check == 0){
            $cat = new Category();
            $cat->product_category = $request->product_category;
            $cat->description = $request->description;
            $cat->user_id = Auth::user()->id;
            $save = $cat->save();

            if(!$save){
                return redirect()->back()->with('alert-danger', 'cannot proccess your data rigth now! please try again later!');
            }

            return redirect()->back()->with('alert-success', 'Product category added');
        }else{
            return redirect()->back()->with('alert-danger', 'Product category already exist');
        }   

    }

    public function destroy(Request $request){
        $delete = Category::where('id', $request->id)->delete();

        if(!$delete){
            return redirect()->back()->with('alert-danger', 'cannot proccess your data rigth now! please try again later!');
        }

         return redirect()->back()->with('alert-success', 'Product category added');
    }
}
