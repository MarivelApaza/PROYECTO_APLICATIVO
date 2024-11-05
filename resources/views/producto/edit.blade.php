@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Productos')
@section('mostrarResumen', false)
@section('contenido')
<br><br>
<div class="container-fluid px-4">
    <div class="card mb-4" style="background-color: #d0ecf1;"> 
        <div class="card-header" style="background-color: #cfbadf ;">
            <h2 class="mt-4">Editar Producto</h2>
        </div>
        <div class="card-body"> 
            <form action="{{ route('producto.update', $producto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $producto->descripcion }}" required>
                </div>

                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio Venta</label>
                    <input type="number" class="form-control" id="precio_venta" name="precio_venta" value="{{ $producto->precio_venta }}" required>
                </div>

                <div class="mb-3">
                    <label for="precio_costo" class="form-label">Precio Costo</label>
                    <input type="number" class="form-control" id="precio_costo" name="precio_costo" value="{{ $producto->precio_costo }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $producto->fecha_ingreso }}" required>
                </div>

                <button type="submit" class="btn btn-success" style="background-color: #a73a63; border: 2px solid #a73a63;">Actualizar Producto</button>
                <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

@endsection
