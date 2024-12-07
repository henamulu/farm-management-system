<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherDashboardController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlanController;
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
    Route::resource('messages', MessageController::class);
    Route::resource('farms.plans', PlanController::class);
    Route::post('plans/{plan}/approve', [PlanController::class, 'approve'])->name('plans.approve');

    // New routes for weather and notifications
    Route::get('/weather', [WeatherDashboardController::class, 'index'])->name('weather.dashboard');
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationsController::class, 'markAsRead'])
        ->name('notifications.mark-as-read');

    // Ruta de prueba de email
    Route::get('/test-email', function () {
        Mail::to('tu_correo@gmail.com')->send(new \App\Mail\TestMail());
        return 'Correo enviado correctamente';
    })->middleware(['auth']);
});

require __DIR__.'/auth.php'; 