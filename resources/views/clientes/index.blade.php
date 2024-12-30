@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para registrar un nuevo cliente -->
    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Cliente</a>

    <!-- Tabla de clientes -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Tipo de Documento</th> <!-- Nueva columna para tipo_documento -->
                <th>Número de Documento</th> <!-- Nueva columna para num_documento -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterar sobre cada cliente y mostrar sus datos -->
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->ciudad }}</td>
                    <td>{{ $cliente->tipo_documento }}</td> <!-- Mostrar tipo_documento -->
                    <td>{{ $cliente->num_documento }}</td> <!-- Mostrar num_documento -->
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar cliente -->
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
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
