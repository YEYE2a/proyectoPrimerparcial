<?php

namespace App\Http\Controllers\Auth;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
public function inicio()
{
    $hoy = now()->toDateString();
    $finSemana = now()->addDays(7)->toDateString();

    $eventosSemana = Evento::whereBetween('fecha', [$hoy, $finSemana])->get();
    $eventosProximos = Evento::where('fecha', '>', $finSemana)->orderBy('fecha')->get();

    return view('welcome', compact('eventosSemana', 'eventosProximos'));
}
}