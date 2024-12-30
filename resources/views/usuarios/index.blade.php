@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->role->nombre ?? 'Sin Rol' }}</td> <!-- Mostrar rol si existe -->
                    <td>
                        <!-- Botón para editar -->
                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
