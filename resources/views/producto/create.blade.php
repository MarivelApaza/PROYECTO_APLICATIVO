@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Productos')
@section('mostrarResumen', false)
@section('contenido')
<br> <br>
<div class="container-fluid px-4">
    <div class="card mb-4" style="background-color: #d0ecf1;"> <!-- Añadir tarjeta para dar estructura -->
        <div class="card-header" style="background-color: #f5def4;">
            <h2 class="mt-4" >Agregar Producto</h2>
        </div>
        <div class="card-body"> <!-- Cuerpo de la tarjeta -->
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Nuevo Producto</li>
            </ol>   
            <form method="POST" action="{{ route('producto.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" required>
                </div>
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                    <input type="text" class="form-control" name="precio_venta" required>
                </div>
                <div class="mb-3">
                    <label for="precio_costo" class="form-label">Precio de Costo</label>
                    <input type="text" class="form-control" name="precio_costo" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" name="stock" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                    <input type="date" class="form-control" name="fecha_ingreso" required>
                </div>
                <input type="submit" class="btn btn-primary" style="background-color: #494ca0;  border: 2px solid #494ca0 ;" value="Guardar Producto">
                <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

@endsection