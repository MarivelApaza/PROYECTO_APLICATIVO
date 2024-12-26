@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nuevo Artículo</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para crear un nuevo artículo -->
    <form action="{{ route('articulos.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
    </div>

    <div class="form-group">
        <label for="precio_venta">Precio de Venta</label>
        <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta') }}" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="precio_costo">Precio de Costo</label>
        <input type="number" name="precio_costo" id="precio_costo" class="form-control" value="{{ old('precio_costo') }}" step="0.01" required>
    </div>


    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>

    <div class="form-group">
        <label for="cod_tipoarticulo">Tipo de Artículo</label>
        <select name="cod_tipoarticulo" id="cod_tipoarticulo" class="form-control">
            @foreach ($tipoArticulos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="cod_proveedor">Proveedor</label>
        <select name="cod_proveedor" id="cod_proveedor" class="form-control">
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
    </div>
<br> <br>
    <button type="submit" class="btn btn-primary">Guardar Artículo</button>
</form>

</div>
@endsection
