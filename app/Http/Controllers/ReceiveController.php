<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recieve;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReceiveController extends Controller
{
    public function index(){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $dateReceived = Recieve::where('user_id', Auth::user()->id)->groupBy('code')->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.receive', compact('month', 'dateReceived', 'suppliers'));
    }

    public function show(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $dateReceived = Recieve::where('user_id', Auth::user()->id)->get();
        $data = Recieve::where('user_id', Auth::user()->id)
                ->where('date_received', $request->date)
                ->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        
        $date = $request->date;

        return view('user.showIn', compact('month', 'dateReceived', 'data', 'date', 'suppliers'));
    }

    public function  createDate(Request $request){

        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $products = Product::where('user_id', Auth::user()->id)->get();
        $data = Recieve::where('user_id', Auth::user()->id)
                ->where('code', $request->code)
                ->get();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $code = $request->code;

        return view('user.store-receive', compact( 'month', 'products', 'data', 'suppliers', 'code'));
    }

    public function store(Request $request){
        $formField = $request->validate([
            'product_id' => 'required',
            'unit' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'barcode' =>  ['required', Rule::unique('recieves', 'barcode')],
        ]);

        if($request->code == null){
            $code = Str::random(5);
        }else{
            $code = $request->code;
        }

        $store = new Recieve();
        $store->user_id = auth()->user()->id;
        $store->product_id = $request->product_id;
        $store->unit = $request->unit;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->barcode = $request->barcode;
        $store->expiry_date = $request->expiry_date;
        $store->amount = $request->amount;
        $store->code = $code;
        $store->original_price = $request->original_price;
        $store->no_unit = $request->no_unit;
        $save = $store->save();
        $id = $store->id;

        $stock = Product::where('id', $request->product_id)->first();
        $stock->remaining_quantity = $stock->remaining_quantity + $request->stock;
        $stock->update();

        $sales = new Inventory();
        $sales->user_id = auth()->user()->id;
        $sales->product_id = $request->product_id;
        $sales->receive_id = $id;
        $sales->code = $code;
        $sales->income = 0;
        $sales->total_sales = '0';
        $sales->sales = 0;
        $sales->save();

        if(!$save){
            return redirect()->back()->with('alert-danger', 'Cannot process stock! please try again later');
        }
        return redirect('/date-receive?user_id='.auth()->user()->id.'&code='.$code)->with('alert-info', 'Stock added successfully');
    }

    public function getUpdate(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $dateReceived = Recieve::where('id', $request->id)->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.update-receive', compact('month', 'dateReceived', 'suppliers'));
    }

    

    public function update(Request $request){
       

        $store = Recieve::where('id', $request->id)->first();
        $store->unit = $request->unit;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->barcode = $request->barcode;
        $store->expiry_date = $request->expiry_date;
        $store->amount = $request->amount;
        $save = $store->update();

        $stock = Product::where('id', $request->product_id)->first();

        if($request->stock == $store->stock){
            $stock->remaining_quantity = $request->stock;
        }elseif($request->stock > $store->stock){
            $stock->remaining_quantity = $stock->remaining_quantity + $request->stock;
        }elseif($request->stock < $store->stock){
            $stock->remaining_quantity = $stock->remaining_quantity - $request->stock;
        }

        $stock->update();

        if(!$save){
            return redirect()->back()->with('alert-danger', 'Cannot update stock! please try again later');
        }
        return redirect()->back()->with('alert-info', 'Stock updated successfully');
    }

    public function destroy(Request $request){
        $inventory = Inventory::where('receive_id', $request->id)->first();
        $inventory->delete();

        $destroy = Recieve::where('id', $request->id)->first();
        $product = Product::where('id', $destroy->product_id)->first();
        $product->remaining_quantity = $destroy->stock - $product->remaining_quantity;
        $product->update();
        $save = $destroy->delete();

        if(!$save){
            return redirect()->back()->with('alert-danger', 'Cannot process request! please try again later');
        }
        return redirect()->back()->with('alert-info', 'Stock deleted successfully');
        
    }
}
