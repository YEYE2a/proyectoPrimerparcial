@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Entradas Compradas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($entradas->count() > 0)
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Localidad</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Fecha Compra</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entradas as $entrada)
            <tr>
                <td>{{ $entrada->localidad->evento->nombre }}</td>
                <td>{{ $entrada->localidad->nombre }}</td>
                <td>${{ number_format($entrada->localidad->precio, 2) }}</td>
                <td>
                    @if($entrada->estado == 'reembolsado')
                        <span class="badge bg-secondary">Reembolsado</span>
                    @else
                        <span class="badge bg-success">Comprado</span>
                    @endif
                </td>
                <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($entrada->estado == 'comprado')
                    <form action="{{ route('entradas.reembolsar', $entrada->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reembolsar</button>
                    </form>
                    @else
                        —
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No has comprado ninguna entrada.</p>
    @endif
</div>
@endsection
