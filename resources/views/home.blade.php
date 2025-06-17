@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp
@section('content')
<div class="container">
    <h2 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">Mis Entradas</div>
                <div class="card-body">
                    @if($misEntradas->count())
                        <ul class="list-group">
                            @foreach($misEntradas as $entrada)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $entrada->localidad->evento->nombre }} - {{ $entrada->localidad->nombre }}
                                    <span class="badge bg-{{ $entrada->estado == 'comprado' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($entrada->estado) }}
                                    </span>
                                </div>
                                
                                @if($entrada->estado === 'comprado')
                                    <form action="{{ route('entradas.reembolsar', $entrada->id) }}" method="POST" class="ms-2">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro que deseas reembolsar esta entrada?')">Reembolsar</button>
                                    </form>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No has comprado entradas aún.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">Eventos Próximos</div>
                <div class="card-body">
                    @if($eventosProximos->count())
                        <ul class="list-group">
                            @foreach($eventosProximos as $evento)
                                <li class="list-group-item">
                                    {{ $evento->nombre }} - {{ $evento->fecha }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay eventos próximos.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">Boletos Disponibles</div>
        <div class="card-body">
            @foreach($todosEventos as $evento)
                <div class="mb-3">
                    <h5>{{ $evento->nombre }}</h5>
                    <p>{{ Str::limit($evento->descripcion, 100) }}</p>
                    <p><strong>{{ $evento->localidades->sum('capacidad') }}</strong> boletos disponibles</p>
                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-outline-primary btn-sm">Ver Evento</a>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
