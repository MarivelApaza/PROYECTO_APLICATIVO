@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Proveedores')
@section('mostrarResumen', false)
@section('contenido')
<br><br>
<div class="container-fluid px-4">
    <div class="card mb-4" style="background-color: #d0ecf1;"> 
        <div class="card-header" style="background-color: #f5def4;">
            <h2 class="mt-4">Agregar Proveedor</h2>
        </div>
        <div class="card-body"> 
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Nuevo Proveedor</li>
            </ol>   
            <form method="POST" action="{{ route('proveedor.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </div>
                <div class="mb-3">
                    <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                    <input type="text" class="form-control" name="nombre_comercial" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" required>
                </div>
                <input type="submit" class="btn btn-primary" style="background-color: #494ca0; border: 2px solid #494ca0;" value="Guardar Proveedor">
                <a href="{{ route('proveedor.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
