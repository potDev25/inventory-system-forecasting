<?php

namespace App\Http\Controllers\User;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Charts\InventoryChart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Total;
use Illuminate\Support\Facades\Auth;

class ForecastController extends Controller
{
    public function sales(Request $request){
        $getmonth = Inventory::where('user_id', Auth::user()->id)->latest()->first();
       
        if(!isset($getmonth->month)){
            $month = "";
        }else{
            $month = $getmonth->month;
        }
        //$date = Inventory::where('user_id', Auth::user()->id)->groupBy('date')->get();

        $total_sales = Total::where('user_id', Auth::guard()->user()->id)->get()->pluck('total_sales', 'month');
        $chart = new InventoryChart;


        $chart->labels($total_sales->keys());
        $chart->dataset('Total Sales' , 'bar', $total_sales->values())->options([
            'borderColor' => 'red',
        ]); 

        $varDate = $request->date;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        //for prediction
        $data = $total_sales->values();
        $last_value = count($data);
        $need_to_predict = $data[$last_value - 1];
        $test1 = $need_to_predict * 1.3956;
        $final = $test1 - 19.3305;

        $test2 = $test1 * 1.3956;
        $final2 = $test2 - 19.3305;

        $test3 = $test2 * 1.3956;
        $final3 = $test3 *  19.3305;

        $sales_pr = [
            $final,
            $final2,
            $final3
        ];
        $label = [
            '1',
            '2',
            '3'
        ];

        $pr1 = $need_to_predict * 1.3956;
        $value1 = $pr1 - 19.3305;

        $pr2 = $pr1 * 1.3956;
        $value2 = $pr2 - 19.3305;

        $pr3 = $pr2 * 1.3956;
        $value3 = $pr3 - 19.3305;

        $pr4 = $pr3 * 1.3956;
        $value4 = $pr4 - 19.3305;

        $pr5 = $pr4 * 1.3956;
        $value5 = $pr5 - 19.3305;

        $pr6 = $pr5 * 1.3956;
        $value6 = $pr6 - 19.3305;

        $pr7 = $pr6 * 1.3956;
        $value7 = $pr7 - 19.3305;

        $pr8 = $pr7 * 1.3956;
        $value8 = $pr8 - 19.3305;

        $pr9 = $pr8 * 1.3956;
        $value9 = $pr9 - 19.3305;

        $pr10 = $pr9 * 1.3956;
        $value10 = $pr10 - 19.3305;

        $pr11 = $pr10 * 1.3956;
        $value11 = $pr11 - 19.3305;

        $pr12 = $pr11 * 1.3956;
        $value12 = $pr12 - 19.3305;

        $annual = [
            $value1,
            $value2,
            $value3,
            $value4,
            $value5,
            $value6,
            $value7,
            $value8,
            $value9,
            $value10,
            $value11,
            $value12,
        ];
        $annual_key = [
            '1','2','3','4','5','6','7','8','9','10','11','12'
        ];

        $predict = new InventoryChart;

        $predict->labels($label);
        $predict->dataset('Total Sales For Next  Months' , 'line', $sales_pr)->options([
            'borderColor' => 'blue',
        ]);
        
        $predict->labels($annual_key);
        $predict->dataset('Total Sales For Annual' , 'line', $annual)->options([
            'borderColor' => 'green',
        ]);

        return view('user.sales' ,compact('month', 'chart', 'varDate', 'suppliers', 'predict', 'annual'));
    }

    public function salesForecast(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $date = Inventory::where('user_id', Auth::user()->id)->groupBy('date')->get();

        $inv = Inventory::with('product')->where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->get()->pluck('sales', 'product.product_name');
        $sales = new InventoryChart;

        $maxItem = Inventory::where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->withMax('product','product_name')->get()->pluck('sales', 'product.product_name');
        $result = new InventoryChart;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        /*$income =  Product::withSum('inventories','income')->get()->pluck('inventories_sum_income', 'product_name');
        dd($income);*/



        $val = $inv->values(1);

        for($i = 0; $i < count($val); $i++){

            if($val[$i] < 100){
                $val[$i] = $val[$i] - $val[$i] / 5;
            }else{
                $val[$i] = $val[$i] + 100;
            }
        }

        //dd($inv);
        $sales->labels($inv->keys());
        $sales->dataset('Current Sales Value' , 'line', $inv->values())->options([
            'borderColor' => 'red',
        ]); 
        $sales->dataset('Next Three Month Sales Value' , 'line', $val)->options([
            'borderColor' => 'blue',
            'backgroundColor' => ''
        ]);
        
        $result->labels($maxItem->keys());
        $result->dataset('Visualization of items' , 'bar', $val)->options([
            'borderColor' => 'blue',
            'backgroundColor' => 'blue',

        ]); 

        return view('user.s-forecast' ,compact('month', 'sales', 'date', 'result', 'suppliers'));
    }

    public function income(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $date = Inventory::where('user_id', Auth::user()->id)->groupBy('date')->get();
        $actualDate = $request->date;

        $inv = Inventory::with('product')->where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->get()->pluck('income', 'product.product_name');
        $income = new InventoryChart;
        $incomeBar = new InventoryChart;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        /*$income =  Product::withSum('inventories','income')->get()->pluck('inventories_sum_income', 'product_name');
        dd($income);*/

        $val = $inv->values(1);

        for($i = 0; $i < count($val); $i++){

            if($val[$i] < 100){
                $val[$i] = $val[$i] - $val[$i] / 5;
            }else{
                $val[$i] = $val[$i] + 200;
            }
        }

        //dd($inv);
        $income->labels($inv->keys());
        $income->dataset('Current Income Value' , 'line', $inv->values())->options([
            'borderColor' => 'red',
        ]); 
        $income->dataset('Next Three Month Income Value' , 'line', $val)->options([
            'borderColor' => 'blue',
            'backgroundColor' => ''
        ]);

        $incomeBar->labels($inv->keys());
        $incomeBar->dataset('Forecast Visualize' , 'bar', $val)->options([
            'borderColor' => 'blue',
            'backgroundColor' => 'blue'
        ]);
        
        return view('user.income-forecast' ,compact('month', 'income', 'date', 'incomeBar', 'actualDate', 'suppliers'));
    }

    public function annualSalesForecast(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $date = Inventory::where('user_id', Auth::user()->id)->groupBy('date')->get();
        $actualDate = $request->date;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        $inv = Inventory::with('product')->where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->get()->pluck('sales', 'product.product_name');
        $sales = new InventoryChart;

        $maxItem = Inventory::where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->withMax('product','product_name')->get()->pluck('sales', 'product.product_name');
        $result = new InventoryChart;

        /*$income =  Product::withSum('inventories','income')->get()->pluck('inventories_sum_income', 'product_name');
        dd($income);*/

        $val = $inv->values(1);

        for($i = 0; $i < count($val); $i++){

            if($val[$i] < 100){
                $val[$i] = $val[$i] - $val[$i] / 50;
            }else{
                $val[$i] = ($val[$i] + 100) + (10/2);
            }
        }

        //dd($inv);
        $sales->labels($inv->keys());
        $sales->dataset('Current Sales Value' , 'line', $inv->values())->options([
            'borderColor' => 'green',
        ]); 
        $sales->dataset('Annual sales of items' , 'line', $val)->options([
            'borderColor' => 'red',

        ]);
        
        $result->labels($maxItem->keys());
        $result->dataset('Annual sales of items' , 'bar', $val)->options([
            'borderColor' => 'red',

        ]); 

        return view('user.annualSales-forecast' ,compact('month', 'sales', 'date', 'result', 'actualDate', 'suppliers'));
    }

    public function annualIncomeForecast(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $date = Inventory::where('user_id', Auth::user()->id)->groupBy('date')->get();
        $actualDate = $request->date;
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();

        $inv = Inventory::with('product')->where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->get()->pluck('income', 'product.product_name');
        $sales = new InventoryChart;

        $maxItem = Inventory::where('user_id', Auth::guard()->user()->id)->where('date', $request->date)->withMax('product','product_name')->get()->pluck('income', 'product.product_name');
        $result = new InventoryChart;

        /*$income =  Product::withSum('inventories','income')->get()->pluck('inventories_sum_income', 'product_name');
        dd($income);*/

        $val = $inv->values(1);

        for($i = 0; $i < count($val); $i++){

            if($val[$i] < 100){
                $val[$i] = $val[$i] - $val[$i] / 50;
            }else{
                $val[$i] = ($val[$i] * 12) / (10/2);
            }
        }

        //dd($inv);
        $sales->labels($inv->keys());
        $sales->dataset('Current Sales Value' , 'line', $inv->values())->options([
            'borderColor' => 'green',
        ]); 
        $sales->dataset('Annual sales of items' , 'line', $val)->options([
            'borderColor' => 'red',

        ]);
        
        $result->labels($maxItem->keys());
        $result->dataset('Annual sales of items' , 'bar', $val)->options([
            'borderColor' => 'red',

        ]); 

        return view('user.annualIncome-forecast' ,compact('month', 'sales', 'date', 'result', 'actualDate', 'suppliers'));
    }
}
