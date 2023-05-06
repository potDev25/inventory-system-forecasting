<?php

namespace App\Http\Controllers\User;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Charts\InventoryChart;
use Illuminate\Support\Carbon;
use App\Imports\InventoryImport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductForecast;
use App\Models\Product;
use App\Models\Recieve;
use App\Models\Supplier;
use App\Models\Total;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class InventoryController extends Controller
{

    public function index(Inventory $inventory){
        $getmonth = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
       
        if(!isset($getmonth->month)){
            $month = "";
        }else{
            $month = $getmonth->month;
        }

        return view('user.inventory', [
            'inventories' => $inventory::where('user_id', Auth::guard('web')->user()->id)->orderBy('created_at', 'DESC')->groupBy('code')->get(),
            'month' => Inventory::where('user_id', Auth::user()->id)->latest()->first(),
            'suppliers' => $suppliers
        ]);
    }

    public function getAdd(){
        $getmonth = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
       
        if(!isset($getmonth->month)){
            $month = "";
        }else{
            $month = $getmonth->month;
        }

        $inventories = Inventory::where('user_id', Auth::guard('web')->user()->id)->orderBy('date')->get();

        return view('user.add-inventory1', compact('month', 'inventories', 'suppliers'));
    }

    public function store(Request $request){
         $request->validate([
            'excel' => 'required|mimes:csv'
        ]);

        Excel::import(new InventoryImport, $request->excel);
        
        return redirect()->back()->with('alert-success', 'Inventory added to the database!');
    }

    public function getUpdate(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $inventory = Inventory::where('id', $request->id)->first();
        $id = $request->id;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        return view('user.update-inventory', compact('month', 'inventory', 'id', 'suppliers'));
    }

    public function update(Request $request, Inventory $inventory){
        $request->validate([
            'sales' => 'required|integer'
        ]);

        $edit = Inventory::where('id', $request->inventory_id)->first();
        $edit->sales = $request->sales;
        $save = $edit->update();

        if(!$save){
            return redirect()->back()->with('alert-danger', 'Could not process your request! please try again later');
        }
         return redirect()->back()->with('alert-success', 'Inventory updated successfully!');
    }


    public function report(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $data = Total::where('user_id', auth()->user()->id)->get();

        $total_income = Total::where('user_id', auth()->user()->id)->get()->pluck('total_income', 'month');
        $chart = new InventoryChart;

        $total_sales = Total::where('user_id', auth()->user()->id)->get()->pluck('total_sales', 'month');

        //total income;
        $chart->labels($total_income->keys());
        $chart->dataset('Total Income' , 'bar', $total_income->values())->options([
            'borderColor' => 'green'
        ]);
        $chart->labels($total_sales->keys());
        $chart->dataset('Total Sales' , 'bar', $total_sales->values())->options([
            'borderColor' => 'red',
        ]);

        
        return view('user.reports', compact('suppliers', 'chart', 'month',  'suppliers', 'data'));
    }

    public function forecast(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $inv = Inventory::where('user_id', Auth::guard()->user()->id)->where('month', $request->current)->pluck('total_sale', 'product_name');
        $rm = $request->month;
        $months = Inventory::where('user_id', Auth::guard()->user()->id)->groupBy('month')->pluck('month');
        $chart = new InventoryChart;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        //dd($inv->month);
        $val = $inv->values(1);

        for($i = 0; $i < count($val); $i++){

            if($val[$i] < 100){
                $val[$i] = $val[$i] - $val[$i] + 10;
            }else{
                $val[$i] = $val[$i] + 100;
            }

            
        }

        $chart->labels($inv->keys());
        $chart->dataset('Current Value' , 'bar', $inv->values())->backgroundColor('red');
        $chart->dataset('Forecast' , 'line', $val)->backgroundColor('#0ca4eb');

        return view('user.sales-forecast', compact('chart', 'months', 'rm', 'month', 'suppliers'));
    }

    public function destroy(Request $request){
        Inventory::where('id', $request->id)->delete();

        return redirect()->back()->with('alert-success', 'Inventory Deleted Successfully');
    }

    public function addDate(Request $request){
        $formField = $request->validate([
            'year' => 'required',
            'month' => 'required',
        ]);

        $date = $request->month.','.$request->year;

        $check = Inventory::where('date', $date)
                ->where('user_id', Auth::user()->id)
                ->first();
        //dd($check);
        if(is_null($check)){
            return redirect('/create-inventory?date='.$date)->with('alert-info', 'Success!');
        }else{
            return redirect()->back()->with('alert-warning', 'You already added this date!');
        }
    }

    public function create(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $products = Recieve::where('user_id', Auth::user()->id)
                    ->get();
        $inventories = Inventory::where('user_id', Auth::guard('web')->user()->id)
                    ->where('code', $request->code)
                    ->get();
        $date = $request->date;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $sum = Inventory::where('code', $request->code)->where('user_id', auth()->user()->id)->sum('income');
        $total_sales = Inventory::where('code', $request->code)->where('user_id', auth()->user()->id)->sum('total_sales');
        $total_value = Total::where('code', $request->code)->first();
        $code = $request->code;
        $total_month = Inventory::where('code', $request->code)->first();

        $product_graphs = Inventory::with('product')->where('code', $request->code)->get()->pluck('sales', 'product.product_name');
        $pr_gr = new InventoryChart;

        $pr_gr->labels($product_graphs->keys());
        $pr_gr->dataset('Product Sales' , 'bar', $product_graphs->values())->options([
            'borderColor' => 'blue',
        ]);

        return view('user.createInventory', compact('pr_gr','total_month', 'total_value', 'code','month', 'date', 'products', 'inventories', 'suppliers', 'sum', 'total_sales'));
    }
}
