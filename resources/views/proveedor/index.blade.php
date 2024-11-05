@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Proveedores')
@section('mostrarResumen', false)
@section('contenido')

<div class="container-fluid px-4">
    <h1 class="mt-4">Lista de Proveedores</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <a class="btn btn-primary" style="background-color: #14a493; border: 2px solid #14a493;" href="{{ route('proveedor.create') }}" role="button">Agregar Proveedor</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead class="custom-table-header"> 
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nombre Comercial</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->apellidos }}</td>
                        <td>{{ $proveedor->nombre_comercial }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>
                            <a href="{{ route('proveedor.edit', $proveedor->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('proveedor.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">Eliminar</button>
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
