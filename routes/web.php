<?php

use App\Http\Controllers\BuyProductController;
use App\Http\Controllers\ProductForecastController;
use App\Http\Controllers\ProductSupplierController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\CreateController;
use App\Http\Controllers\User\ForecastController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ImportFileController;
use App\Http\Controllers\User\InventoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



    Route::middleware(['guest', 'PreventBackHistory'])->group(function(){
        Route::view('/register', 'register');
        Route::post('/store', [AuthController::class, 'store']);
        Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
        Route::post('/check', [AuthController::class, 'check'])->name('check');
    });


    Route::middleware(['auth:web', 'is_email_verified', 'PreventBackHistory'])->group(function(){
        Route::get('/home', [HomeController::class, 'index']);

        Route::get('/add-product', [HomeController::class, 'addInventory']);

        Route::get('/inventory', [HomeController::class, 'inventory']);

        Route::get('/reports', [InventoryController::class, 'report']);

        Route::get('/products', [ProductController::class, 'index']);

        Route::get('/add-inventory', [InventoryController::class, 'getAdd']);

        Route::get('/update-inventory', [InventoryController::class, 'getUpdate']);

        Route::post('/edit-inventery', [InventoryController::class, 'update']);

        Route::post('delete-inventory', [InventoryController::class, 'destroy']);

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/import-file', [ImportFileController::class, 'store']);

        Route::post('/manual-product', [ProductController::class, 'store']);

        Route::post('/delete-product', [ProductController::class, 'destroy']);

        Route::post('/edit-product', [ProductController::class, 'update']);

        Route::get('/update-product', [ProductController::class, 'getUpdate']);

        Route::post('/import-inventory', [InventoryController::class, 'store']);

        Route::get('/view-inventory', [InventoryController::class, 'index']);

        Route::get('/forecast', [InventoryController::class, 'forecast']);

        Route::get('/profile', [ProfileController::class, 'index']);

        Route::post('/update-profile', [ProfileController::class, 'update']);

        Route::get('/category', [CategoryController::class, 'index']);

        Route::post('/store-category', [CategoryController::class, 'store']);

        Route::post('/destroy-category', [CategoryController::class, 'destroy']);

        Route::post('/add-date', [InventoryController::class, 'addDate']);

        Route::post('/store-inventory', [CreateController::class, 'store']);

        Route::get('/create-inventory', [InventoryController::class, 'create']);

        Route::get('/getInventory', [CreateController::class, 'getInventory']);

        Route::get('/receive', [ReceiveController::class, 'index']);

        Route::get('/date-receive', [ReceiveController::class, 'createDate']);

        Route::get('/in-page', [ReceiveController::class, 'show']);

        Route::get('/update-receive', [ReceiveController::class, 'getUpdate']); 

        Route::post('/edit-recieve', [ReceiveController::class, 'update']); 

        Route::post('/delete-recieve', [ReceiveController::class, 'destroy']); 

        Route::post('/store-product', [ReceiveController::class, 'store']);

        Route::get('/sales-forecast', [ForecastController::class, 'sales']);

        Route::get('/s-forecast', [ForecastController::class, 'salesForecast']);

        Route::get('/income-forecast', [ForecastController::class, 'income']);

        Route::get('/income-forecast', [ForecastController::class, 'income']);

        Route::get('/annual-forecast', [ForecastController::class, 'annualSalesForecast']);

        Route::get('/annualincome-forecast', [ForecastController::class, 'annualIncomeForecast']);

        Route::get('/manage-supplier', [SupplierController::class, 'index']);

        Route::post('/store-supplier', [SupplierController::class, 'store']);

        Route::post('/edit-supplier', [SupplierController::class, 'update']);

        Route::post('/delete-supplier', [SupplierController::class, 'destroy']);

        Route::get('/supplier-product', [ProductSupplierController::class, 'index']);

        Route::get('/buy-product', [BuyProductController::class, 'index']);

        Route::post('/store-buy', [BuyProductController::class, 'store']);

        Route::get('/view-product', [BuyProductController::class, 'view_product']);

        Route::get('/forecast-product', [ProductForecastController::class, 'index']);

        Route::post('/total-value', [TotalController::class, 'store']);
    });
