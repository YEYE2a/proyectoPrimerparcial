@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h2>

    <div class="row">

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">Mis Entradas</div>
                <div class="card-body">
                    @if($misEntradas->count())
                        <ul class="list-group">
                            @foreach($misEntradas as $entrada)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $entrada->localidad->evento->nombre }} - {{ $entrada->localidad->nombre }}
                                    <span class="badge bg-{{ $entrada->estado == 'comprado' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($entrada->estado) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No has comprado entradas aún.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">Eventos Próximos</div>
                <div class="card-body">
                    @if($eventosProximos->count())
                        <ul class="list-group">
                            @foreach($eventosProximos as $evento)
                                <li class="list-group-item">
                                    {{ $evento->nombre }} - {{ $evento->fecha }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay eventos próximos.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">Boletos Disponibles</div>
        <div class="card-body">
        @foreach($evento->localidades as $localidad)
            <li>
                {{ $localidad->nombre }} — ${{ number_format($localidad->precio, 2) }} — {{ $localidad->capacidad }} disponibles

                @auth
                <form action="{{ route('entradas.comprar', $localidad->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Comprar</button>
                </form>
                @endauth
            </li>
        @endforeach
        </div>
    </div>
</div>
@endsection
