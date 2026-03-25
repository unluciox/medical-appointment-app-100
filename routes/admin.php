<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\GenericController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
  return view('admin.dashboard');
})->name('dashboard');

//Gestion de roles

Route::resource('roles', RoleController::class);
Route::resource('generic', GenericController::class);
Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class);
