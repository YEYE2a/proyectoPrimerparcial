@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <h2>Crear Localidades</h2>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.localidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Evento</label>
            <select name="evento_id" class="form-control" required>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}" {{ (isset($evento_id) && $evento_id == $evento->id) ? 'selected' : '' }}>
                        {{ $evento->nombre }}
                    </option>
                @endforeach
            </select>
        </div>


        @php
            $zonas = ['General', 'VIP', 'Palco'];
        @endphp

        @foreach($zonas as $index => $zona)
        <div class="border rounded p-3 mb-4">
            <h5>Zona {{ $zona }}</h5>
            <input type="hidden" name="localidades[{{ $index }}][nombre]" value="{{ $zona }}">

            <div class="mb-3">
                <label>Precio</label>
                <input type="number" step="0.01" name="localidades[{{ $index }}][precio]" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Capacidad</label>
                <input type="number" name="localidades[{{ $index }}][capacidad]" class="form-control" required>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success">Guardar Localidades</button>
        <a href="{{ route('admin.localidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

