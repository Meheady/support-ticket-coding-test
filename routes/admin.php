<?php

use App\Http\Controllers\Admin\AdminController;
use  Illuminate\Support\Facades\Route;



Route::middleware(['admin','auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


