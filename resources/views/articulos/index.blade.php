@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Artículos</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('articulos.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Artículo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Precio de Venta</th>
                <th>Precio de Costo</th>
                <th>Stock</th>
                <th>Tipo de Artículo</th>
                <th>Proveedor</th>
                <th>Fecha de Ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
                <tr>
                    <td>{{ $articulo->descripcion }}</td>
                    <td>{{ $articulo->precio_venta }}</td>
                    <td>{{ $articulo->precio_costo }}</td>
                    <td>{{ $articulo->stock }}</td>
                    <td>{{ $articulo->tipoArticulo->descripcion }}</td> <!-- Relación con tipo_articulo -->
                    <td>{{ $articulo->proveedor->nombre }}</td> <!-- Relación con proveedor -->
                    <td>{{ $articulo->fecha_ingreso }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar artículo -->
                        <form action="{{ route('articulos.destroy', $articulo->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
