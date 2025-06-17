@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Eventos Disponibles</h2>

    @foreach($eventos as $evento)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <!-- Imagen lateral -->
                <div class="col-md-4 d-flex">
                    <img src="{{ $evento->imagen_url ?? 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29uY2llcnRvJTIwZGUlMjBhZG9yYWNpJUMzJUIzbnxlbnwwfHwwfHx8MA%3D%3D' }}"
                        alt="Concierto"
                        class="img-fluid rounded-start"
                        style="width: 100%; object-fit: cover; height: 100%;">

                </div>

                <!-- Info -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">{{ $evento->nombre }}</h4>
                        <p class="card-text">{{ $evento->descripcion }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }} {{ $evento->hora }}</p>
                        <p><strong>Lugar:</strong> {{ $evento->lugar }}</p>
                        <hr>

                        @foreach($evento->localidades as $localidad)
                            <div class="mb-2">
                                <strong>{{ $localidad->nombre }}</strong> — ${{ $localidad->precio }}<br>
                                Disponibles: {{ $localidad->capacidad - $localidad->entradas->where('estado', 'comprado')->count() }}

                                <form action="{{ route('compras.comprar', $localidad->id) }}" method="POST" class="d-inline ms-2">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Comprar</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
