<?php

namespace App\Http\Controllers;

use App\Charts\InventoryChart;
use App\Models\ForecastProduct;
use App\Models\ForecastProductAnnual;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductForecastController extends Controller
{
    public function index(Request $request){
        $month = Inventory::where('user_id', Auth::user()->id)->latest()->first();
        $suppliers = Supplier::where('user_id', Auth::user()->id)->get();
        $total_month = Inventory::where('code', $request->code)->first();
        $inventories = Inventory::where('user_id', Auth::guard('web')->user()->id)
            ->where('code', $request->code)
            ->get();

        $data = array();
        $annualdata = array();

        $product_graphs = Inventory::with('product')->where('code', $request->code)->get()->pluck('sales', 'product.product_name');
        $pr_gr = new InventoryChart;

        $pr_gr->labels($product_graphs->keys());
        $pr_gr->dataset('Product Sales' , 'line', $product_graphs->values())->options([
            'borderColor' => 'red',
        ]);

        $value = $product_graphs->values();
        $label = $product_graphs->keys();
        
        for($i = 0; $i < count($value); $i++){
            $need_to_predict = $value[$i];
            $test1 = $need_to_predict * 1.3956;
            $final = $test1 - 19.3305;

            $test2 = $test1 * 1.3956;
            $final2 = $test2 - 19.3305;

            $test3 = $test2 * 1.3956;
            $final3 = $test3 *  19.3305;

            $data = [
                'total_sales' => $final3,
                'product_name' => $label[$i],
                'code' => $request->code
            ];

            $check = ForecastProduct::where('code', $request->code)
                    ->where('product_name', $label[$i])
                    ->first();

            if($check == null){
                ForecastProduct::create($data);
            }

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

            $annualdata = [
                'total_sales' => $value12,
                'product_name' => $label[$i],
                'code' => $request->code
            ];

            $check1 = ForecastProductAnnual::where('code', $request->code)
                    ->where('product_name', $label[$i])
                    ->first();

            if($check1 == null){
                ForecastProductAnnual::create($annualdata);
            }
        }

        $product_forecast = ForecastProduct::where('code', $request->code)->get()->pluck('total_sales', 'product_name');
        $product_forecast1 = ForecastProductAnnual::where('code', $request->code)->get()->pluck('total_sales', 'product_name');
        $pr_gr1 = new InventoryChart;
        
        $pr_gr1->labels($product_forecast->keys());
        $pr_gr1->dataset('Product Sales for next quarter' , 'bar', $product_forecast->values())->options([
            'borderColor' => 'blue',
        ]);
        $pr_gr1->labels($product_forecast1->keys());
        $pr_gr1->dataset('Product Sales annual' , 'bar', $product_forecast1->values())->options([
            'borderColor' => 'red',
        ]);

        $getProduct = ForecastProduct::where('code', $request->code)->get();
        $getProductAnnual = ForecastProductAnnual::where('code', $request->code)->get();


        return view('user.product-forecast', compact('getProductAnnual' ,'getProduct' ,'pr_gr','month', 'suppliers', 'inventories', 'total_month', 'pr_gr1'));
    }
}
