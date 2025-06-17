@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <h2 class="mb-4">Editar Evento</h2>

    <form action="{{ route('admin.eventos.update', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del evento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $evento->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $evento->fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $evento->hora) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
