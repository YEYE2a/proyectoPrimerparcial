<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EntradaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('eventos.show');
Route::post('/entradas/comprar', [EntradaController::class, 'comprar'])->name('entradas.comprar');
Route::get('/mis-entradas', [EntradaController::class, 'misEntradas'])->name('entradas.mis');
Route::post('/entradas/reembolsar/{id}', [EntradaController::class, 'reembolsar'])->name('entradas.reembolsar');
Route::post('/comprar-entrada/{localidad}', [EntradaController::class, 'comprar'])->name('entradas.comprar')->middleware('auth');
