@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Eventos de esta semana</h2>
    @if($eventosSemana->count())
        @foreach($eventosSemana as $evento)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 d-flex">
                    <img src="{{ $evento->imagen_url ?: 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000' }}"
                         alt="Concierto Reggaetón"
                         class="img-fluid rounded-start"
                         style="width: 100%; object-fit: cover; height: 100%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4>{{ $evento->nombre }}</h4>
                        <p>{{ Str::limit($evento->descripcion, 120) }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }} {{ $evento->hora }} |
                        <strong>Asientos disponibles:</strong> {{ $evento->localidades->sum('capacidad') }}</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-sm btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No hay eventos esta semana.</p>
    @endif

    <h2 class="mt-5 mb-4">Eventos próximos</h2>
    @if($eventosProximos->count())
        @foreach($eventosProximos as $evento)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 d-flex">
                    <img src="{{ $evento->imagen_url ?: 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000' }}"
                         class="img-fluid rounded-start"
                         alt="Evento"
                         style="width: 100%; object-fit: cover; height: 100%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4>{{ $evento->nombre }}</h4>
                        <p>{{ Str::limit($evento->descripcion, 120) }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }} {{ $evento->hora }} |
                        <strong>Asientos disponibles:</strong> {{ $evento->localidades->sum('capacidad') }}</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-sm btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No hay eventos próximos.</p>
    @endif
</div>
@endsection
