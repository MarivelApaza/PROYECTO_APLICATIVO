@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Proveedores')
@section('mostrarResumen', false)
@section('contenido')
<br><br>
<div class="container-fluid px-4">
    <div class="card mb-4" style="background-color: #d0ecf1;"> 
        <div class="card-header" style="background-color: #cfbadf;">
            <h2 class="mt-4">Editar Proveedor</h2>
        </div>
        <div class="card-body"> 
            <form action="{{ route('proveedor.update', $proveedor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proveedor->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $proveedor->apellidos }}" required>
                </div>

                <div class="mb-3">
                    <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{ $proveedor->nombre_comercial }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $proveedor->telefono }}" required>
                </div>

                <button type="submit" class="btn btn-success" style="background-color: #a73a63; border: 2px solid #a73a63;">Actualizar Proveedor</button>
                <a href="{{ route('proveedor.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
