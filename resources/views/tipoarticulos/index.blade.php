@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Tipos de Artículos</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tipoarticulos.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Tipo de Artículo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipoArticulos as $tipoArticulo)
                <tr>
                    <td>{{ $tipoArticulo->descripcion }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('tipoarticulos.edit', $tipoArticulo->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar tipo de artículo -->
                        <form action="{{ route('tipoarticulos.destroy', $tipoArticulo->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tipo de artículo?');">
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
