<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Entrada;
use App\Models\Localidad;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('localidades')->get();
        return view('compras.index', compact('eventos'));
    }

    public function comprar(Localidad $localidad)
    {
        $user = Auth::user();

        // Verificar si hay disponibilidad
        $compradas = $localidad->entradas()->where('estado', 'comprado')->count();
        if ($compradas >= $localidad->capacidad) {
            return back()->with('error', 'Localidad agotada.');
        }

        // Registrar entrada
        Entrada::create([
            'user_id' => $user->id,
            'localidad_id' => $localidad->id,
            'estado' => 'comprado',
            'codigo_qr' => uniqid(),
        ]);

        return redirect()->route('compras.mis_eventos')->with('success', 'Entrada comprada exitosamente.');
    }

    public function misEventos()
    {
        $entradas = Auth::user()->entradas()->with('localidad.evento')->get();
        return view('compras.mis_eventos', compact('entradas'));
    }
}

