@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Localidades del evento: {{ $evento->nombre }}</h3>

    @foreach($evento->localidades as $localidad)
    
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">{{ $localidad->nombre }}</h5>
                    <p>
                        <strong>Precio:</strong> ${{ number_format($localidad->precio, 2) }}<br>
                        <strong>Capacidad:</strong> {{ $localidad->capacidad }}<br>
                        <strong>Vendidas:</strong> {{ $localidad->entradas->where('estado', 'comprado')->count() }}<br>
                        <strong>Disponibles:</strong> {{ $localidad->capacidad - $localidad->entradas->where('estado', 'comprado')->count() }}
                    </p>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.localidades.edit', $localidad->id) }}" class="btn btn-sm btn-warning mb-1">Editar</a>
                    <form action="{{ route('admin.localidades.destroy', $localidad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta localidad?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>

            @php $compradas = $localidad->entradas->where('estado', 'comprado'); @endphp

            @if($compradas->count())
                <button class="btn btn-sm btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#entradas-{{ $localidad->id }}">
                    Ver compradores ({{ $compradas->count() }})
                </button>

                <div class="collapse" id="entradas-{{ $localidad->id }}">
                    <ul class="list-group">
                        @foreach($compradas as $entrada)
                            <li class="list-group-item">
                                {{ $entrada->usuario->name }} — <small>{{ $entrada->created_at->format('d/m/Y H:i') }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-muted">Aún no hay entradas vendidas para esta localidad.</p>
            @endif
        </div>
    </div>
    @endforeach

    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Volver al Panel</a>
</div>
@endsection
