@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <h2 class="mb-4">Localidades</h2>

    <a href="{{ route('admin.localidades.create') }}" class="btn btn-primary mb-3">+ Nueva Localidad</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($localidades as $localidad)
            <tr>
                <td>{{ $localidad->evento->nombre }}</td>
                <td>{{ $localidad->nombre }}</td>
                <td>${{ number_format($localidad->precio, 2) }}</td>
                <td>{{ $localidad->capacidad }}</td>
                <td>
                    <a href="{{ route('admin.localidades.edit', $localidad->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.localidades.destroy', $localidad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta localidad?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
