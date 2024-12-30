@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Editar Proveedor</h1>

    <!-- Formulario de edición -->
    <form action="{{ route('proveedores.update', ['proveedor' => $proveedor->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método PUT para actualización -->

        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{ old('proveedor', $proveedor->proveedor) }}" required>
        </div>

        <div class="form-group">
            <label for="contacto">Contacto</label>
            <input type="text" name="contacto" id="contacto" class="form-control" value="{{ old('contacto', $proveedor->contacto) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $proveedor->telefono) }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $proveedor->direccion) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
    </form>
</div>

@endsection
