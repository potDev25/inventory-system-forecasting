<?php

namespace App\Http\Controllers\User;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Charts\InventoryChart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    public function index(Request $request){
        $date = $request->date;
        $gmonth = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $getmonth = Inventory::where('user_id', Auth::user()->id)->groupBy('code')->get();
        $prod = Product::where('user_id', Auth::user()->id)->count();
        $cat = Category::where('user_id', Auth::user()->id)->count();
        $sup = Supplier::where('user_id', Auth::user()->id)->count();
        $products = Product::where('remaining_quantity', '<=', 20)->where('user_id', Auth::user()->id)->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        if(!isset($gmonth->month)){
            $month = "";
        }else{
            $month = $gmonth->month;
        }


        if(!isNull($gmonth)){
            if(isset($date)){
                $actdate = $date;
            }else{
                $actdate =  $gmonth->date;
            }
        }else{
            $actdate = $date;
        }

        

        $sum = Inventory::where('user_id', auth()->user()->id)->sum('income');
    
        return view('user.home', compact('sup', 'month','gmonth', 'prod', 'products', 'getmonth', 'actdate', 'sum', 'cat', 'suppliers'));
        
    }

    public function addInventory(){

        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        $products = Product::where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'DESC')->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.add-inventory', compact('month', 'categories', 'products', 'suppliers'));
    }

    public function inventory(){

        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.inventory', compact('month', 'suppliers'));
    }
}
