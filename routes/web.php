<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarreraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarreraController::class, 'index']);
Route::get('/obtener-carrera', [CarreraController::class, 'obtenerCarrera']);

Route::post('/guardar-carrera', [CarreraController::class, 'guardarCarrera']);
Route::put('/editar-carrera/{id}', [CarreraController::class, 'editarCarrera']);
Route::delete('/eliminar-carrera/{id}', [CarreraController::class, 'eliminarCarrera']);



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
