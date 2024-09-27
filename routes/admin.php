<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketResponseController;
use App\Http\Controllers\Customer\TicketController;
use  Illuminate\Support\Facades\Route;



Route::middleware(['admin','auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/create', [AdminController::class, 'adminCreate'])->name('admin.create');
    Route::get('/admin/list', [AdminController::class, 'allAdmin'])->name('admin.list');
    Route::post('/admin/store', [AdminController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/admin/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.delete');


    Route::controller(DepartmentCOntroller::class)->group(function () {
        Route::get('/departments', 'index')->name('admin.departments');
        Route::post('/departments', 'store')->name('admin.departments.store');
        Route::get('/departments/{department}', 'show')->name('admin.departments.show');
        Route::post('/departments-update/{department}', 'update')->name('admin.departments.update');
        Route::get('/departments-delete/{department}', 'destroy')->name('admin.departments.destroy');
    });

    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/tickets/view/{id}', [TicketController::class, 'viewTicket'])->name('admin.tickets.view');

    Route::post('/tickets-reply/{id}', [TicketResponseController::class,'reply'])->name('admin.tickets.reply');

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('admin.settings');
        Route::post('/settings-update', 'update')->name('admin.settings.update');
    });

    Route::post('/email-configuration', [EmailConfigurationController::class, 'updateEmailConf'])->name('email.config.update');
});


