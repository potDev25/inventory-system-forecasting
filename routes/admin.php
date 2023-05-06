<?php

use App\Http\Controllers\Admin\AdminCotroller;
use App\Http\Controllers\User\AuthController;
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

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function(){
       Route::view('/admin', 'admin.auth.login');

       Route::post('/admin-login', [AdminCotroller::class, 'check']);
    });


    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function(){
        Route::get('/admin-home', [AdminCotroller::class, 'index']);

        Route::get('/user-profile', [AdminCotroller::class, 'user']);

        Route::post('/admin-block', [AdminCotroller::class, 'block']);

        Route::post('/admin-logout', [AdminCotroller::class, 'logout']);
    });
