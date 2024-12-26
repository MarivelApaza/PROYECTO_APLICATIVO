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
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar venta -->
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">
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
