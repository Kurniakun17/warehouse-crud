<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('transactions', TransactionController::class);
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('items.index');
    }
    return redirect()->route('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
