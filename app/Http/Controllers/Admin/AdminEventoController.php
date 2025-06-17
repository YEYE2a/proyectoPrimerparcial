<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Controllers\Controller;


class AdminEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::all();
        return view('admin.eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eventos.create');//
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'lugar' => 'required|string|max:255',
        ]);
    
        $evento = Evento::create($request->all());
    
        return redirect()->route('admin.localidades.create', ['evento_id' => $evento->id])
            ->with('success', 'Evento creado correctamente. Ahora añade las localidades.');
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
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $evento->update($request->only(['nombre', 'descripcion', 'fecha', 'hora']));

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado.');//
    }
}
