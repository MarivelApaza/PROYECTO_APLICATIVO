@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Proveedores</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Proveedor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->proveedor }}</td>
                    <td>{{ $proveedor->contacto }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar proveedor -->
                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">
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
