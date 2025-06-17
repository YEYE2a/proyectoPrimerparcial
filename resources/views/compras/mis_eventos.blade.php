@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Entradas Compradas</h2>

    @if($entradas->isEmpty())
        <p>No has comprado entradas todavía.</p>
    @endif

    @foreach($entradas as $entrada)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $entrada->localidad->evento->nombre }}</h5>
                <p><strong>Fecha:</strong> {{ $entrada->localidad->evento->fecha }} {{ $entrada->localidad->evento->hora }}</p>
                <p><strong>Lugar:</strong> {{ $entrada->localidad->evento->lugar }}</p>
                <p><strong>Localidad:</strong> {{ $entrada->localidad->nombre }} — ${{ $entrada->localidad->precio }}</p>
                <p><strong>Código QR:</strong> {{ $entrada->codigo_qr }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
