<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositoTypeController;
use App\Http\Controllers\TransactionController;
use App\Models\DepositoType;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::fallback(function() {
    return redirect('/customers');
});

Route::resource('customers', CustomerController::class);
Route::resource('deposito-type', DepositoTypeController::class);
Route::resource('account', AccountController::class);
Route::resource('transaction', TransactionController::class);
