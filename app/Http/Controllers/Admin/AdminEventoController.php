<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Controllers\Controller;

class AdminEventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('localidades.entradas.usuario')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'lugar' => 'required',
            'imagen_url' => 'nullable|url',
        ]);

        $evento = Evento::create($request->all());

        return redirect()->route('admin.localidades.create', ['evento_id' => $evento->id])
                         ->with('success', 'Evento creado con éxito. Ahora añade las localidades.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'lugar' => 'required',
            'imagen_url' => 'nullable|url',
        ]);

        $evento = Evento::findOrFail($id);
        $evento->update($request->all());

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id); 
        $evento->delete();
        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado.');
    }
}
