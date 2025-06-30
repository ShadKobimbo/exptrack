<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Excel export route inside the auth group
    Route::get('/expenses/export', [ExpenseController::class, 'export'])->name('expenses.export');

    // ✅ Resource routes
    Route::resource('expenses', ExpenseController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('users', UserController::class);
});
