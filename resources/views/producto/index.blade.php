@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Productos')
@section('mostrarResumen', false)
@section('contenido')

<div class="container-fluid px-4">
    <h1 class="mt-4">Lista de Productos</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <a class="btn btn-primary" style="background-color: #14a493;  border: 2px solid #14a493 ; " href="{{ route('producto.create') }}" role="button">Agregar Producto</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead class="custom-table-header"> 
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Precio Venta</th>
                        <th>Precio Costo</th>
                        <th>Stock</th>
                        <th>Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        <td>{{ $producto->precio_costo }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->fecha_ingreso }}</td>
                        <td>
                            <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection