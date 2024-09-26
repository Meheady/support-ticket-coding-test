<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SettingController;
use  Illuminate\Support\Facades\Route;



Route::middleware(['admin','auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    Route::controller(DepartmentCOntroller::class)->group(function () {
        Route::get('/departments', 'index')->name('admin.departments');
        Route::post('/departments', 'store')->name('admin.departments.store');
        Route::get('/departments/{department}', 'show')->name('admin.departments.show');
        Route::post('/departments-update/{department}', 'update')->name('admin.departments.update');
        Route::get('/departments-delete/{department}', 'destroy')->name('admin.departments.destroy');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('admin.settings');
        Route::post('/settings-update', 'update')->name('admin.settings.update');
    });
});


