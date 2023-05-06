<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        

        return view('user.manage-supplier', compact('month', 'suppliers'));
    }

    public function store(Request $request){
        $form = $request->validate([
            'supplier' => 'required',
            'owner' => 'required',
            'address' => 'required'
        ]);

        $form['user_id'] = Auth::user()->id;

        $save = Supplier::create($form);

        if($save){
            return redirect()->back()->with('alert-success', 'Supplier added successfully');
        }else{
            return redirect()->back()->with('alert-warning', 'We cannot proccess your request please try again later');
        }
    }

    public function update(Request $request){
        $form = $request->validate([
            'supplier' => 'required',
            'owner' => 'required',
            'address' => 'required'
        ]);


        $save = Supplier::where('id', $request->id)->update($form);

        if($save){
            return redirect()->back()->with('alert-success', 'Supplier edit successfully');
        }else{
            return redirect()->back()->with('alert-warning', 'We cannot proccess your request please try again later');
        }
    }

    public function destroy(Request $request){

        $save = Supplier::where('id', $request->id)->delete();

        if($save){
            return redirect()->back()->with('alert-success', 'Supplier deleted successfully');
        }else{
            return redirect()->back()->with('alert-warning', 'We cannot proccess your request please try again later');
        }
    }
}
