<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class AdminEntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with(['user', 'localidad.evento'])->latest()->get();
        return view('admin.entradas.index', compact('entradas'));
    }

    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();
        return redirect()->route('admin.entradas.index')->with('success', 'Entrada eliminada.');
    }
}
