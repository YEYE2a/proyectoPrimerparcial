@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <h2>Editar Localidad</h2>

    <form action="{{ route('admin.localidades.update', $localidad->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Evento</label>
            <select name="evento_id" class="form-control" required>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}" {{ $evento->id == $localidad->evento_id ? 'selected' : '' }}>
                        {{ $evento->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $localidad->nombre }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" step="0.01" value="{{ $localidad->precio }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacidad" value="{{ $localidad->capacidad }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.localidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
