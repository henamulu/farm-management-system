<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    /* Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Rutas de recursos
    Route::resource('farms', FarmController::class);
    Route::resource('farms.stocks', StockController::class);
    Route::resource('farms.employees', EmployeeController::class);
    Route::resource('farms.machinery', MachineryController::class);
    // Ruta de prueba de email
    Route::get('/test-email', function () {
        Mail::to('tu_correo@gmail.com')->send(new \App\Mail\TestMail());
        return 'Correo enviado correctamente';
    })->middleware(['auth']);
});

require __DIR__.'/auth.php'; 