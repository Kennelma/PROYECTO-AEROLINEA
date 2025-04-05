<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModuloFacturasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuloReportesController; 
use App\Http\Controllers\ModuloNotificacionesController;
use App\Http\Controllers\ModuloPersonasController; 


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

//RUTAS DEL MODULO DE PERSONAS
Route::get('/ModuloPersonas/{tabla}', [ModuloPersonasController::class, 'informacion'])->name('ModuloPersonas.informacion');
Route::delete('/ModuloPersonas/Eliminar', [ModuloPersonasController::class, 'eliminar'])->name('ModuloPersonas.Eliminar');
Route::post('/ModuloPersonas/Insertar', [ModuloPersonasController::class, 'insertar'])->name('ModuloPersonas.insertar');

//RUTAS DEL MODULO DE NOTIFICACIONES
Route::get('/Notificaciones', [ModuloNotificacionesController::class, 'informacion'])->name('Notificaciones');
Route::post('/Notificaciones', [ModuloNotificacionesController::class, 'insertar']);
Route::delete('/notificaciones/{id}', [ModuloNotificacionesController::class, 'destroy'])->name('Notificaciones.destroy');
Route::put('/notificaciones/{id}', [ModuloNotificacionesController::class, 'update'])->name('Notificaciones.update');

//RUTAS DEL MODULO DE REPORTES
Route::get('/ModuloReportes/{tabla}', [ModuloReportesController::class, 'informacion'])->name('ModuloReportes.informacion');
Route::delete('/ModuloReportes/Eliminar', [ModuloReportesController::class, 'eliminar'])->name('ModuloReportes.Eliminar');
Route::post('/ModuloReportes/Insertar', [ModuloReportesController::class, 'insertar'])->name('ModuloReportes.insertar');

//MODULO FACTURAS
Route::get('/Facturas', [ModuloFacturasController::class, 'informacion'])->name('Facturas');
Route::post('/Facturas', [ModuloFacturasController::class, 'insertar']);
Route::delete('/Facturas/{id}', [ModuloFacturasController::class, 'destroy'])->name('Facturas.destroy');
Route::put('/Facturas/{id}', [ModuloFacturasController::class, 'update'])->name('Facturas.update');


require __DIR__.'/auth.php';
