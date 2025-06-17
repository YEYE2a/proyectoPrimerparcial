<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrada;

class AdminEntradaController extends Controller
{
    // Mostrar todas las entradas compradas
    public function index()
    {
        $entradas = Entrada::with(['usuario', 'localidad.evento'])->latest()->get();

        return view('admin.entradas.index', compact('entradas'));
    }

    // Eliminar una entrada (simulación de reembolso)
    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return back()->with('success', 'Entrada eliminada (reembolso simulado) correctamente.');
    }
}
