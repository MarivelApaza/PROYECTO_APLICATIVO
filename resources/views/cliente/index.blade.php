@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Clientes')
@section('mostrarResumen', false)
@section('contenido')

<div class="container-fluid px-4">
    <h1 class="mt-4">Lista de Clientes</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <a class="btn btn-primary" style="background-color: #14a493; border: 2px solid #14a493;" href="{{ route('cliente.create') }}" role="button">Agregar Cliente</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead class="custom-table-header"> 
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombres }}</td>
                        <td>{{ $cliente->apellidos }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>
                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
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
