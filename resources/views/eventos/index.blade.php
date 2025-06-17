@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Eventos Disponibles</h1>

    @foreach ($eventos as $evento)
    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4 d-flex">
<img src="{{ $evento->imagen_url ?? 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29uY2llcnRvJTIwZGUlMjBhZG9yYWNpJUMzJUIzbnxlbnwwfHwwfHx8MA%3D%3D' }}"
     class="img-fluid rounded-start"
     alt="Evento"
     style="width: 100%; object-fit: cover; height: 100%;">

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <p class="card-text">{{ $evento->fecha }} - {{ $evento->hora }}</p>
                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-primary mt-2">Ver detalles</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
