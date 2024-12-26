<!-- resources/views/clientes/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nuevo Cliente</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para crear un nuevo cliente -->
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" class="form-control" value="{{ old('ciudad') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
    </form>
</div>
@endsection
