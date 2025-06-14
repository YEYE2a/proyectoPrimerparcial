@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $evento->nombre }}</h2>
    <p><strong>Fecha:</strong> {{ $evento->fecha }} | <strong>Hora:</strong> {{ $evento->hora }}</p>
    <p><strong>Lugar:</strong> {{ $evento->lugar }}</p>
    <p>{{ $evento->descripcion }}</p>

    <h4 class="mt-4">Localidades</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Zona</th>
                <th>Precio</th>
                <th>Capacidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evento->localidades as $localidad)
            <tr>
                <td>{{ $localidad->nombre }}</td>
                <td>${{ number_format($localidad->precio, 2) }}</td>
                <td>{{ $localidad->capacidad }}</td>
                <td>
                    @auth
                    <form method="POST" action="{{ route('entradas.comprar') }}">
                        @csrf
                        <input type="hidden" name="localidad_id" value="{{ $localidad->id }}">
                        <button type="submit" class="btn btn-success btn-sm">Comprar</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Inicia sesión para comprar</a>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
