<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\TicketController;
use Illuminate\Support\Facades\Route;



Route::middleware(['customer','auth'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::controller(TicketController::class)->group(function () {
       Route::get('/tickets', 'index')->name('customer.tickets');
       Route::get('/tickets/create', 'create')->name('customer.tickets.create');
       Route::post('/tickets', 'store')->name('customer.tickets.store');
    });
});
