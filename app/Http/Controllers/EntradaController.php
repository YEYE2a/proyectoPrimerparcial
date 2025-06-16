<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Localidad;
use Illuminate\Support\Facades\Auth;

class EntradaController extends Controller
{
    public function comprar($localidadId)
    {
        $localidad = Localidad::findOrFail($localidadId);

    if ($localidad->capacidad <= 0) {
        return back()->with('error', 'No hay más boletos disponibles para esta localidad.');
        }
        $entrada = new Entrada();
        $entrada->user_id = Auth::id();
        $entrada->localidad_id = $localidad->id;
        $entrada->estado = 'comprado';
        $entrada->save();
        $localidad->capacidad -= 1;
        $localidad->save();

    return back()->with('success', 'Entrada comprada exitosamente.');
    
    }
    public function misEntradas()
{
    $entradas = Entrada::with('localidad.evento')
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('entradas.mis', compact('entradas'));
}
    public function reembolsar($id)
{
    $entrada = Entrada::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $entrada->estado = 'reembolsado';
    $entrada->save();

    return redirect()->back()->with('success', 'Entrada reembolsada exitosamente.');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
