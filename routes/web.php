<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts/home');
});

Route::resource('/orders', OrderController::class);
Route::resource('/products', ProductController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/users', UserController::class);
Route::resource('/companies', CompanyController::class);
Route::resource('/transactions', TransactionController::class);
