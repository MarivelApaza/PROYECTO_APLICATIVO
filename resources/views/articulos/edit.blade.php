@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Artículo</h1>

    <!-- Formulario de edición -->
    <form action="{{ route('articulos.update', $articulos->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método PUT para actualización -->

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $articulos->descripcion) }}" required>
        </div>

        <div class="form-group">
            <label for="precio_venta">Precio de Venta</label>
            <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta', $articulos->precio_venta) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="precio_costo">Precio de Costo</label>
            <input type="number" name="precio_costo" id="precio_costo" class="form-control" value="{{ old('precio_costo', $articulos->precio_costo) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $articulos->stock) }}" required>
        </div>

        <div class="form-group">
            <label for="cod_tipo_articulo">Tipo de Artículo</label>
            <select name="cod_tipo_articulo" id="cod_tipo_articulo" class="form-control" required>
                @foreach($tipos as $tipo) <!-- Cambia 'tipoArticulos' a 'tipos' -->
                    <option value="{{ $tipo->id }}" {{ old('cod_tipo_articulo', $articulos->cod_tipo_articulo) == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="cod_proveedor">Proveedor</label>
            <select name="cod_proveedor" id="cod_proveedor" class="form-control" required>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ old('cod_proveedor', $articulos->cod_proveedor) == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->proveedor }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_ingreso">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $articulos->fecha_ingreso) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
