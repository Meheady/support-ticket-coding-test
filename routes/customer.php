<?php

use App\Http\Controllers\Admin\TicketResponseController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\TicketController;
use Illuminate\Support\Facades\Route;



Route::middleware(['customer','auth'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::controller(TicketController::class)->group(function () {
       Route::get('/tickets', 'index')->name('customer.tickets');
       Route::get('/tickets/create', 'createTicket')->name('customer.tickets.create');
       Route::get('/tickets/view/{id}', 'viewTicket')->name('customer.tickets.view');
       Route::post('/tickets', 'storeTicket')->name('customer.tickets.store');
    });


    Route::post('/tickets-reply/{id}', [TicketResponseController::class,'reply'])->name('customer.tickets.reply');


});
