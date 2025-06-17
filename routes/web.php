<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\InicioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEventoController;
use App\Http\Controllers\Admin\LocalidadController;
use App\Http\Controllers\Admin\AdminEntradaController;

Route::get('/', [InicioController::class, 'inicio'])->name('inicio');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('eventos.show');

Route::middleware('auth')->group(function () {
    Route::get('/mis-entradas', [EntradaController::class, 'misEntradas'])->name('entradas.mis');
    Route::post('/entradas/comprar', [EntradaController::class, 'comprar'])->name('entradas.comprar');
    Route::post('/entradas/reembolsar/{id}', [EntradaController::class, 'reembolsar'])->name('entradas.reembolsar');
    Route::post('/comprar-entrada/{localidad}', [EntradaController::class, 'comprar'])->name('entradas.comprar.directa');
    Route::post('/reembolsar-entrada/{id}', [EntradaController::class, 'reembolsar'])->name('entradas.reembolsar.directa');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('eventos', AdminEventoController::class)->names('admin.eventos');
    Route::resource('localidades', LocalidadController::class)->names('admin.localidades');
    Route::get('entradas', [AdminEntradaController::class, 'index'])->name('admin.entradas.index');
    Route::delete('entradas/{id}', [AdminEntradaController::class, 'destroy'])->name('admin.entradas.destroy');
    Route::get('eventos/{evento}/localidades', [LocalidadController::class, 'porEvento'])->name('admin.eventos.localidades');
    Route::get('admin/localidades/evento/{eventoId}', [LocalidadController::class, 'porEvento'])->name('admin.localidades.por_evento');
});

