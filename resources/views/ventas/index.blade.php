@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tipo de Artículo</th>
                <th>Fecha y Hora</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->cliente->nombre }}</td> <!-- Nombre del cliente -->
                <td>
                    @foreach($venta->productos as $producto)
                        {{ $producto->tipoArticulo?->descripcion ?? 'No asignado' }}<br>
                    @endforeach
                </td> 
                <td>{{ $venta->fecha_hora }}</td>
                <td>{{ number_format($venta->total, 2) }}</td> <!-- Total de la venta -->
                <td>{{ $venta->estado }}</td> <!-- Estado de la venta -->
                <td>
                    <!-- Botón de editar -->
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('ventas.pdf', $venta->id) }}" class="btn btn-primary">Imprimir PDF</a>

                    <!-- Botón de eliminar (Formulario de eliminación) -->
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta venta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
