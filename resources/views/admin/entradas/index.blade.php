@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Entradas Vendidas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Evento</th>
                <th>Localidad</th>
                <th>Estado</th>
                <th>Fecha de Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entradas as $entrada)
            <tr>
                <td>{{ $entrada->user->name }}</td>
                <td>{{ $entrada->localidad->evento->nombre }}</td>
                <td>{{ $entrada->localidad->nombre }}</td>
                <td>
                    <span class="badge bg-{{ $entrada->estado === 'comprado' ? 'success' : 'secondary' }}">
                        {{ ucfirst($entrada->estado) }}
                    </span>
                </td>
                <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.entradas.destroy', $entrada->id) }}" method="POST" onsubmit="return confirm('¿Eliminar entrada?')">
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
