<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.profile', compact('month', 'suppliers'));

    }

    public function update(Request $request, User $userprofile)
    {
        $formField = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'business' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image')){
            $formField['image'] = $request->file('image')->store('logos', 'public');
        }

        $save = User::where('id', Auth::user()->id)->update($formField);

        if($save){
            return redirect()->back()->with('alert-success', 'profile update successfully');
        }

        return redirect()->back()->with('alert-danger', 'cannot update profile! please try again later');
    }
}
