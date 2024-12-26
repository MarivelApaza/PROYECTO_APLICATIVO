<!-- resources/views/proveedores/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nuevo Proveedor</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para crear un nuevo proveedor -->
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{ old('proveedor') }}" required>
        </div>

        <div class="form-group">
            <label for="contacto">Contacto</label>
            <input type="text" name="contacto" id="contacto" class="form-control" value="{{ old('contacto') }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
    </form>
</div>
@endsection
