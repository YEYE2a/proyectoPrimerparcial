@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Eventos Disponibles</h1>
    <div class="row">
        @foreach ($eventos as $evento)
        <div class="col-md-4">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <p>{{ $evento->fecha }} - {{ $evento->hora }}</p>
                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
