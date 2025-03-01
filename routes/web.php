<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rutas públicas para administradores
Route::prefix('admin')->group(function () {
    // Mostrar formulario de registro
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');

    // Procesar el registro
    Route::post('/register', [AuthController::class, 'register']);

    // Mostrar formulario de inicio de sesión
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');

    // Procesar el inicio de sesión
    Route::post('/login', [AuthController::class, 'login']);
});

// Ruta del dashboard para administradores (protegida)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return "¡Bienvenido al panel de administración!";
    })->name('admin.dashboard');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
