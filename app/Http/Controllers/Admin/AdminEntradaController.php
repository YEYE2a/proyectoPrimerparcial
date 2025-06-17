<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrada;

class AdminEntradaController extends Controller
{

    public function index()
    {
        $entradas = Entrada::with(['usuario', 'localidad.evento'])->latest()->get();

        return view('admin.entradas.index', compact('entradas'));
    }


    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return back()->with('success', 'Entrada eliminada (reembolso simulado) correctamente.');
    }
}
