<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Doctors
        Route::get('/doctors', \App\Livewire\Admin\Doctor\Index::class)->name('doctors.index');
        Route::get('/doctors/create/{doctor_id?}', \App\Livewire\Admin\Doctor\Create::class)->name('doctors.create');
        Route::get('/doctors/{doctor}/schedule', \App\Livewire\Admin\Doctor\ScheduleManager::class)->name('doctors.schedule');

        // Appointments
        Route::get('/appointments', \App\Livewire\Admin\Appointment\Index::class)->name('appointments.index');
        Route::get('/appointments/create/{appointment_id?}', \App\Livewire\Admin\Appointment\Create::class)->name('appointments.create');
        
        // Consultations
        Route::get('/consultations/{appointment}', \App\Livewire\Admin\ConsultationManager::class)->name('consultation.manager');
    });
});
