@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestión de Eventos</h2>
        <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">+ Crear Evento</a>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Localidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre }}</td>
                <td>{{ $evento->fecha }} {{ $evento->hora }}</td>
                <td>
                    @foreach($evento->localidades as $localidad)
                        <div class="mb-1">
                            <strong>{{ $localidad->nombre }}</strong> - {{ $localidad->capacidad }} totales
                            <br>
                            <span class="text-success">{{ $localidad->entradas->where('estado', 'comprado')->count() }} compradas</span> /
                            <span class="text-muted">
                                {{ $localidad->capacidad - $localidad->entradas->where('estado', 'comprado')->count() }} disponibles
                            </span>
                            @foreach($localidad->entradas->where('estado', 'comprado') as $entrada)
                                <br>
                                <small>- Comprado por:
                                    {{ $entrada->usuario ? $entrada->usuario->name : 'Usuario eliminado' }}
                                </small>
                            @endforeach
                        </div>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.eventos.edit', $evento->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a>
                    <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" class="d-inline mb-1" onsubmit="return confirm('¿Deseas eliminar este evento?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    <a href="{{ route('admin.eventos.localidades', $evento->id) }}" class="btn btn-info btn-sm mt-1">Ver Localidades</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
