<?php

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;



Route::middleware(['customer','auth'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});
