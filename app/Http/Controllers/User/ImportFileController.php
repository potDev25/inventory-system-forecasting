<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;

class ImportFileController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'excel' => 'required|mimes:xlsx'
        ]);

        $r = Excel::import(new ProductImport, $request->excel);
        

        return redirect('/add-inventory')->with('alert-success', 'You have imported your data successfully!');
    }
}
