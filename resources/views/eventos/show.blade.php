@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-4">
<img src="{{ $evento->imagen_url ?? 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29uY2llcnRvJTIwZGUlMjBhZG9yYWNpJUMzJUIzbnxlbnwwfHwwfHx8MA%3D%3D' }}"
     class="img-fluid rounded-start"
     alt="Evento"
     style="width: 100%; object-fit: cover; height: 100%;">

    </div>

    <h2>{{ $evento->nombre }}</h2>
    <p><strong>Fecha:</strong> {{ $evento->fecha }} a las {{ $evento->hora }}</p>
    <p><strong>Lugar:</strong> {{ $evento->lugar }}</p>
    <p>{{ $evento->descripcion }}</p>

    <hr>

    <h4>Localidades disponibles</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="text-center mb-4">
        <img src="{{ asset('images/estadio.png') }}" alt="Mapa del estadio" class="img-fluid" style="max-width: 600px;">
        <div class="mt-3 d-flex justify-content-center gap-3">
            <span class="badge bg-success">General</span>
            <span class="badge bg-warning text-dark">VIP</span>
            <span class="badge bg-purple text-white" style="background-color: #6f42c1;">Palco</span>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Zona</th>
                <th>Precio</th>
                <th>Capacidad</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evento->localidades as $localidad)
            <tr>
                <td>{{ $localidad->nombre }}</td>
                <td>${{ number_format($localidad->precio, 2) }}</td>
                <td>{{ $localidad->capacidad }}</td>
                <td>
                    @auth
                        @if($localidad->capacidad > 0)
                        <form action="{{ route('entradas.comprar', $localidad->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Comprar</button>
                        </form>
                        @else
                        <span class="text-danger">Agotado</span>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Inicia sesión</a>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('eventos.index') }}" class="btn btn-secondary">← Volver a eventos</a>
</div>
@endsection
