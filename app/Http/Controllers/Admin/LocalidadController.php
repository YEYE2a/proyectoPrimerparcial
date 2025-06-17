<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Localidad;
use App\Models\Evento;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::with('evento')->get();
        return view('admin.localidades.index', compact('localidades'));//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $evento_id = $request->input('evento_id');
    $eventos = Evento::all();
    return view('admin.localidades.create', compact('eventos', 'evento_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidades' => 'required|array|min:1',
            'localidades.*.precio' => 'required|numeric|min:0',
            'localidades.*.capacidad' => 'required|integer|min:0',
        ]);
    
        foreach ($request->localidades as $localidadData) {
            \App\Models\Localidad::create([
                'evento_id' => $request->evento_id,
                'nombre' => $localidadData['nombre'],
                'precio' => $localidadData['precio'],
                'capacidad' => $localidadData['capacidad'],
            ]);
        }
    
        return redirect()->route('admin.eventos.localidades', $request->evento_id)
        ->with('success', 'Localidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        $eventos = Evento::all();
        return view('admin.localidades.edit', compact('localidad', 'eventos'));
    }//
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:0',
        ]);

        $localidad = Localidad::findOrFail($id);
        $localidad->update($request->all());

        return redirect()->route('admin.localidades.por_evento', $localidad->evento_id)
                     ->with('success', 'Localidad actualizada correctamente.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localidad = Localidad::findOrFail($id);
        $eventoId = $localidad->evento_id;
        $localidad->delete();
        return redirect()->route('admin.eventos.localidades', $eventoId)
        ->with('success', 'Localidad eliminada.');//
    }
    public function porEvento($eventoId)
    {
        $evento = Evento::with('localidades.entradas')->findOrFail($eventoId);
        return view('admin.localidades.por_evento', compact('evento'));
    }

}
